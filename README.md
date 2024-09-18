# Women-s-Savings-Group

The Mahila Bachat Gat Management System is an online platform designed to help manage women's saving groups (Bachat Gats) in India. It empowers women by providing tools to save, invest, and access financial support.


# Introduction

The Mahila Bachat Gat Management System is an online platform designed to manage women's saving groups in India. The system simplifies tasks such as:
- Record-keeping
- Financial management
- Communication

The main goal is to empower women by providing tools for managing loans at low interest rates, saving, and generating returns on investments.


# Zero Level Data Flow Diagram (DFD)

## Central Entity: Mahila Bachat Gat

### Processes:
- **Monthly Deposit:** Members deposit funds regularly.
- **Add Member:** New members can join the group.
- **Request for Loan:** Members can request loans.
- **Loan:** Loans are approved and disbursed.

### Data Stores:
- **Members Section:** Stores information about members.
- **Admin Section:** Stores administrative data.
- **Monthly Deposit:** Records monthly deposits.
- **Loan:** Manages loan information.

### Data Flows:
- Members deposit money into the Monthly Deposit store.
- New members are added to the Members Section.
- Loan requests are submitted to the system.
- Approved loans are disbursed from the Loan store.


## Features
- Monthly Deposits
- Loan Requests and Disbursement
- Member Management
- Low-Interest Loans


## Tech Stack
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP, XAMPP
- **Database:** MySQL (configured in `gnjn.php`)

# System Flow Diagram

## Start:
- **Login:** Admin or member logs into the system.

### Admin Actions:
- Add Other Loan
- Sent Money
- Add Notification
- Add New User
- View Other Loans
- View User List
- View Distributed Loans
- View Loan Requests
- Logout

### Member Actions:
- Add Money
- Add Loan Request
- View Request Status
- View Profile
- View Notifications
- Receive Loan
- Logout

## End

