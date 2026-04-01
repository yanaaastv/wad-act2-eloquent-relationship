# Insurance Policy Management System (Activity 2)

![WAD-act2](https://github.com/user-attachments/assets/f32d897d-f51e-467e-a554-2efae7491193)


### [ERD Link here!](https://drive.google.com/file/d/1fPQR6L1Lrnw31vclpTZ2dFhV73vcYWa9/view?usp=sharing)

## Database Relationships Overview

| Relationship | Entities | Logic (Business Rule) | Laravel Method |
| :--- | :--- | :--- | :--- |
| **One-to-One (1:1)** | Customer ↔ Profile | A customer has one physical profile record. | `hasOne()` / `belongsTo()` |
| **One-to-Many (1:N)** | Customer ↔ Policy | A customer can have many insurance policies. | `hasMany()` / `belongsTo()` |
| **Many-to-Many (N:M)** | Policy ↔ Vehicle | A policy covers many vehicles (Car, Motorcycle); a vehicle can be under multiple policies. | `belongsToMany()` |

---

## Tech Stack & Implementation

* **Framework:** Laravel 13 
* **Language:** PHP 8.3 (Using **PHP 8 Attributes** for Model Fillables)
* **Database:** SQLite 

