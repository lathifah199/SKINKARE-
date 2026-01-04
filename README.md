## SKINKARE (Artificial Intelligence-Based Early Detection of Stunting Application through Machine Learning Methods)

Project Description:
SKINKARE, which stands for Stunting Kids INsight via Camera & Artificial Intelligence for Recovery, is an innovative stunting detection system that utilizes a camera to scan children’s height through MediaPipe and processes the data using Convolutional Neural Network (CNN) for height estimation. The predicted height is then combined with anthropometric data such as weight, age, and gender, and analyzed using the Random Forest algorithm and Z-Score classification based on Indonesia’s national child growth standards. This approach allows SKINKARE to automatically classify stunting risk levels, and efficient early detection.

---
## Installation

Clone the project

```bash
  git clone https://github.com/lathifah199/SKINKARE-
```

Go to the project directory

```bash
  cd SKINKARE
```

Install dependencies

```bash
  composer install
```

Start the server

```bash
  php artisan serve
```

Create Storage symlink

```bash
  php artisan storage:link
```

Import the Database

```bash
  Make sure you have MySQL and phpMyAdmin installed. then:
    1. open http://localhost/phpmyadmin
    2. Create a new database named skinkare
    3. Go to the import tab
    4. Upload the file skinkare.sql (provided in this project)
    5. Click Go

  The skinkare.sql file is located in a folder named /database.
```

## Usage

* Open the homepage in your browser.
* Click the “Add Child Data” , fiiling the form and klik scan button to begin the scanning process.
* Capture or upload the child’s full-body image using the camera.
* The system detects the child’s height automatically using MediaPipe and a Convolutional Neural Network (CNN) model.
* Input additional anthropometric data such as weight, age, and gender.
* The system processes the combined data using a Random Forest algorithm and Z-Score classification, based on Indonesia’s national child growth standards (Permenkes No. 2 of 2020).
* After analysis, the result page displays:

  * Stunting classification result (Normal or At Risk)
  * Growth visualization graph based on Z-Score
  * Personalized recommendations for prevention and action steps according to the child’s risk level
* Users can view their examination history for monitoring progress over time.
* Health workers can access the admin dashboard to review, manage, and analyze all recorded data.

---

## Demo

Local version:  
http://127.0.0.1:8000/SKINKARE  

Online version (under development):  
https://skinkare-production.up.railway.app/SKINKARE


---

## Link

* [Video Demo Aplikasi](https://youtu.be/xSZFNB6utNI?si=7ogxVGcUGlgWhnDu)
* [Video Presentasi](https://youtu.be/Ys8cyAotTMo?si=Z0B647QaOkejOqHV)
* [Laporan PBL SKINKARE](https://drive.google.com/file/d/1JeMQ3fX8eupwU7gcVY1R-lGuYDF-jJIJ/view?usp=drive_link)

---

## Credits

* **Lathifah Khalifatunnisa** – 331241059
* **Saskia Ananda Irawan** – 3312401070
* **Grace Anastasya Simanungkalit** – 3312401073
* **Ameylia Sandy Putri Azzahra** – 3312401081

Project developed as part of a PBL (Project-Based Learning) assignment in Informatics Engineering, Politeknik Negeri Batam
