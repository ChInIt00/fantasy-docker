# ISSKS - 2024

## Proiektuaren deskripzioa
Informazio Sistemen Seguritatea Kudeatzeko Sistemak irakasgairen Web Sistema arloko proiektua.

Gure taldea bideoklub baten webgunea egin du. 

## Taldekideak
- **Eneko Aguirre**
- **Abaran de Prado**
- **Uriel Martin**
- **Liam Suárez Costumero**
- **Oihan Torrontegi Azkorra**

## Docker-en hedatzeko argibideak

### Baldintzak
- Docker instalatuta izatea.
- Git instalatuta izatea.

### Jarraitu beharreko pausuak
1. Errepositorio hau makina lokalean klonatu.
2. Errepositorioa dagoen direktorioan kokatu gure terminalean.
3. "Dockerfile" bidez sortzen den irudia sortu: `docker build -t "web" .`
4. "docker-compose.yml" fitxategiak daukan kontainerrak sortu: `docker-compose up`
5. Datu basea phpMyAdmin bitartez importatu. Horretarako, proiektu honetan "database.sql" fitxategi bat eskaintzen da, hori kargatu behar da. Horretarako, <http://localhost:8890> linka erabili eta "admin" erabiltzailea eta "test" pasahitza erabili programan sartu ahal izteko. Bertan, "database" sakatu eta "Importar" botoia agertuko da. Irekiko den leioan, "database.sql" fitxategia igo behar izango da.
6. Behin datu basea kargatuta dagoela, <http://localhost:81> link-a erabili web sistema nabigatzailean kargatzeko. 
7. Web Sistema zehazki nola erabiltzen den jakiteko,  ".pdf" fitxategia erabili.
8. Zerbitzua eteteko, Ctrl+C erabili edo beste terminal batetik `docker-compose stop` erabili.
