# Reserveringssysteem voor B&B (Laravel)

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
git clone git@github.com:tallandcollege/field-project-met-externe-po-ddk-1.git
cd field-project-met-externe-po-ddk-1
```

**Installeer dependencies**

```bash
composer install
npm install && npm run dev
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
php artisan migrate --seed
```

**Start de server**

```bash
php artisan serve
```

Open `http://localhost:8000` / `http://127.0.0.1:8000` in je browser.

---


## 🔧 Belangrijke artisan-commando's

* Migraties en seed de database: `php artisan migrate --seed`


---

## 🖼️ Screenshots

**Dashboard**
<img width="1920" height="1080" alt="DashboardAfbeelding" src="https://github.com/user-attachments/assets/0f641692-1181-4804-b7e1-d10cbdede33e" />

**Reserveringsoverzicht**
<img width="1920" height="1080" alt="ReserveringenAfbeelding" src="https://github.com/user-attachments/assets/0c148c6b-ee89-4f9f-957b-f34070f784f6" />

**Gastenoverzicht**
<img width="1919" height="1080" alt="GastenAfbeelding" src="https://github.com/user-attachments/assets/ddbb9fee-09e3-4e6c-aed2-bcbb847a0440" />

**Kamerbeheer**
<img width="1920" height="1080" alt="KamersAfbeelding" src="https://github.com/user-attachments/assets/836a2722-b546-4084-a4b0-fcf4c1c7111c" />

**Admin paneel**
<img width="1919" height="1080" alt="AdminAfbeelding" src="https://github.com/user-attachments/assets/bab1a3b2-fe40-4420-ac80-be88c5a95ceb" />

**Instellingen**
<img width="1920" height="1080" alt="InstellingenAfbeelding" src="https://github.com/user-attachments/assets/96ccfa53-55e2-4efb-b72f-ac42008d2132" />


---

## 👥 Team

* Daan
* Damien
* Kars
