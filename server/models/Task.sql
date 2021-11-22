CREATE TABLE IF NOT EXISTS uw_task (
    id INT AUTO_INCREMENT,
    id_user INT,
    title VARCHAR(255) NOT NULL,
    urgency TINYINT NOT NULL,
    description TEXT,
    due_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (id_user)
        REFERENCES uw_user (id)
        ON UPDATE RESTRICT ON DELETE CASCADE
);
