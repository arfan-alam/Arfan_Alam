<?php
function init_db($pdo) {
    $sql = <<<SQL
CREATE TABLE IF NOT EXISTS hospitals (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL UNIQUE
);
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    role TEXT NOT NULL CHECK(role IN ('patient','healthcare','admin')),
    hospital_id INTEGER,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id)
);
CREATE TABLE IF NOT EXISTS vaccines (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL UNIQUE,
    total_stock INTEGER NOT NULL DEFAULT 0
);
CREATE TABLE IF NOT EXISTS vaccine_stock (
    hospital_id INTEGER NOT NULL,
    vaccine_id INTEGER NOT NULL,
    stock_qty INTEGER NOT NULL DEFAULT 0,
    PRIMARY KEY (hospital_id, vaccine_id),
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS doses (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    patient_id INTEGER NOT NULL,
    vaccine_id INTEGER NOT NULL,
    dose_number INTEGER NOT NULL,
    scheduled_date TEXT,
    completed_date TEXT,
    status TEXT NOT NULL DEFAULT 'scheduled' CHECK(status IN ('scheduled','completed','missed')),
    hospital_id INTEGER,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(id) ON DELETE CASCADE,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id)
);
CREATE TABLE IF NOT EXISTS vaccinations_log (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    patient_id INTEGER NOT NULL,
    vaccine_id INTEGER NOT NULL,
    dose_number INTEGER NOT NULL,
    date_given TEXT NOT NULL,
    hospital_id INTEGER,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vaccine_id) REFERENCES vaccines(id) ON DELETE CASCADE,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id)
);

INSERT INTO hospitals (name) VALUES ('City Health Center'), ('Green Clinic'), ('River Hospital');

INSERT INTO vaccines (name, total_stock) VALUES ('BCG', 1000), ('Polio', 1200), ('MMR', 900);
INSERT INTO vaccine_stock (hospital_id, vaccine_id, stock_qty)
SELECT h.id, v.id, 200 FROM hospitals h CROSS JOIN vaccines v;

-- Default admin and healthcare user
INSERT INTO users (name, email, password_hash, role) VALUES
('Admin', 'admin@example.com', :admin_pass, 'admin'),
('Nurse Joy', 'nurse@example.com', :hc_pass, 'healthcare');

SQL;
    $stmt = $pdo->prepare($sql);
    // supply password hashes for admin/healthcare
    $stmt->bindValue(':admin_pass', password_hash('admin123', PASSWORD_BCRYPT));
    $stmt->bindValue(':hc_pass', password_hash('nurse123', PASSWORD_BCRYPT));
    $stmt->execute();
}
?>
