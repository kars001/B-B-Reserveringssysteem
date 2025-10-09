# Reserveringssysteem voor B&B

## Over dit project

Dit project is een **reserveringssysteem** voor **Talland Bed & Business**.
Met dit systeem kun je eenvoudig:

* Reserveringen beheren
* Kamers en beschikbaarheid bijhouden
* Gasteninformatie opslaan
* Een overzicht krijgen van alle verblijven

Het systeem is gebouwd met **Laravel**, waardoor het schaalbaar, veilig en onderhoudbaar is.

---

## Vereisten

* PHP 8.1+
* Composer
* Node.js & npm
* MySQL of gelijkwaardige database (SQLITE)
* Git

---

## Quick-start (lokale omgeving)

**Clone de repository**

```bash
git clone git@github.com:kars001/B-B-Reserveringssysteem.git
```

**Installeer dependencies**

```bash
composer install
npm install
```

**Maak een `.env` bestand**

```bash
cp .env.example .env
```

Vul je database- en mailgegevens in `.env`.

**Genereer app key**

```bash
php artisan key:generate
```

**Voer migraties & seeders uit**

```bash
php artisan migrate:fresh --seed
```

**Link de storage**

```bash
php artisan storage:link
```

**Start de server**

```bash
php artisan serve && npm run dev
```

Open `http://127.0.0.1:8000` in je browser.

---


## 🖼️ Screenshots

**Dashboard**
<img width="1920" height="1080" alt="DashboardAfbeelding" src="https://github.com/kars001/B-B-Reserveringssysteem/blob/main/Documentation/readme/496585007-0f641692-1181-4804-b7e1-d10cbdede33e.png" />

**Reserveringsoverzicht**
<img width="1920" height="1080" alt="ReserveringenAfbeelding" src="https://github.com/kars001/B-B-Reserveringssysteem/blob/main/Documentation/readme/Screenshot%202025-10-04%20at%2022-02-36%20B%26B.png" />

**Gastenoverzicht**
<img width="1919" height="1080" alt="GastenAfbeelding" src="https://github.com/kars001/B-B-Reserveringssysteem/blob/main/Documentation/readme/496602009-ddbb9fee-09e3-4e6c-aed2-bcbb847a0440.png" />

**Kamerbeheer**
<img width="1920" height="1080" alt="KamersAfbeelding" src="https://github.com/kars001/B-B-Reserveringssysteem/blob/main/Documentation/readme/496586037-836a2722-b546-4084-a4b0-fcf4c1c7111c.png" />

**Admin paneel**
<img width="1919" height="1080" alt="AdminAfbeelding" src="https://github.com/kars001/B-B-Reserveringssysteem/blob/main/Documentation/readme/496602225-bab1a3b2-fe40-4420-ac80-be88c5a95ceb.png" />

**Instellingen**
<img width="1920" height="1080" alt="InstellingenAfbeelding" src="https://github.com/kars001/B-B-Reserveringssysteem/blob/main/Documentation/readme/496602352-96ccfa53-55e2-4efb-b72f-ac42008d2132.png" />


---

## 👥 Team

* Daan
* Damien
* Kars
