#!/usr/bin/env python3
import os
import time
import logging
import requests
import mysql.connector
from mysql.connector import errors as db_errors

logging.basicConfig(level=logging.INFO, format="%(asctime)s %(levelname)s %(message)s")

DB_HOST = os.getenv("DB_HOST", "db")
DB_PORT = int(os.getenv("DB_PORT", "3306"))
DB_USER = os.getenv("DB_USER", "admin")
DB_PASSWORD = os.getenv("DB_PASSWORD", "test")
DB_NAME = os.getenv("DB_NAME", "database")

API_URL = "https://app.analiticafantasy.com/api/fantasy-players/mercado"
HEADERS = {
    "Content-Type": "application/json",
    "User-Agent": "Mozilla/5.0"
}

def fetch_teams():
    url = "https://app.analiticafantasy.com/api/partidos"
    r = requests.get(url, headers=HEADERS, timeout=10)
    r.raise_for_status()
    data = r.json()
    
    teams = {}

    for match in data["f"]:
        for side in ("h", "a"):  # home y away
            t = match[side]
            teams[t["i"]] = t["n"]
    return teams

def fetch_data():
    r = requests.post(API_URL, json={}, headers=HEADERS, timeout=20)
    r.raise_for_status()
    data = r.json()
    return data["players"]

def connect_db():
    for _ in range(5):
        try:
            conn = mysql.connector.connect(
                host=DB_HOST,
                port=DB_PORT,
                user=DB_USER,
                password=DB_PASSWORD,
                database=DB_NAME,
                autocommit=True,
                charset='utf8mb4'
            )
            return conn
        except db_errors.InterfaceError:
            logging.warning("Esperando a la base de datos...")
            time.sleep(3)
    raise RuntimeError("No se puede conectar a la BD")

def main():
    logging.info("Descargando datos del mercado...")
    players = fetch_data()
    logging.info("Jugadores recibidos: %d", len(players))
    logging.info("Descargando equipos...")
    teams = fetch_teams()

    conn = connect_db()
    cur = conn.cursor()

    # ✅ Insertar/actualizar equipos
    for team_id, team_name in teams.items():
        cur.execute("""
            INSERT INTO teams (id, name)
            VALUES (%s, %s)
            ON DUPLICATE KEY UPDATE name = VALUES(name)
        """, (team_id, team_name))

    teams_dict = teams

    # ✅ Procesar jugadores
    for p in players:
        name = p["i"]["n"]
        value = int(p["mv"]["v"])

        # ✅ Team seguro (algunos jugadores no traen "t")
        team_id = p.get("t", 0)
        team_name = teams_dict.get(team_id, None)  # Si no hay equipo, None

        # Insertar jugador con nombre del equipo
        cur.execute("""
            INSERT INTO players (name, team_id, team)
            VALUES (%s, %s, %s)
            ON DUPLICATE KEY UPDATE
            team_id = VALUES(team_id),
            team = VALUES(team)
        """, (name, team_id, team_name))

        # Obtener id del jugador
        cur.execute("SELECT id FROM players WHERE name = %s", (name,))
        player_id = cur.fetchone()[0]

        # Guardar precio de mercado
        cur.execute("""
            INSERT INTO market_values (player_id, value_eur, date)
            VALUES (%s, %s, CURDATE())
            ON DUPLICATE KEY UPDATE value_eur = VALUES(value_eur)
        """, (player_id, value))
        
    # ✅ Guardamos cambios al final
    conn.commit()

    logging.info("Scraper completado ✅")

if __name__ == "__main__":
    main()
