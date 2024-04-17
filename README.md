
# Exchange Rate - Kazokku

This app was created using Laravel 10, and SQLite. I'ts integrated with [exchangerate-api.com](https://www.exchangerate-api.com/) exchangerate-api.com to collect all the currencies and their rates.
## Installation

Install this project with Docker

```bash
    git clone https://github.com/revanp/exchange-rate-kazokku.git
    docker pull php:8.2-apache
    cd exchange-rate-kazokku
    docker build -t kazokku .
    docker run -d --name kazokku -p <available_port>:80 kazokku
```
    
## FAQ

#### What is the default user?

The default user is Admin

`Username : admin`

`Password : P@ssw0rd`

#### Why the exchange rate table is empty?

You need to run the **Refresh Price** function by clicking the button on the dashboard.

