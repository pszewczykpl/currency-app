# Currency App
## Opis
Currency App to aplikacja do pobierania i przechowywania danych dot. kursów walut z wykorzystaniem NBP API.

Aplikacja posiada:
- Migrację do stworzenia tabeli currencies
- Model/Encję Currency (z polami id, name, currency_code, exchange_rate)
- CurrencyApiService (który wykorzystywany jest w celu połączenia z API NBP, pobierania danych i zapisywania ich w bazie danych)
- Kontroler oraz widoki, który udostępnia /currencies (podgląd danych z bazy) oraz /currencies/fetch (pobranie danych z API NBP)
- Komendę update:currencies uruchamianą codziennie w celu automatycznej aktualizacji danych w bazie danych.
## Technologie
- PHP 8.2
- Laravel 9
- MySQL
- Guzzle HTTP
## Demo
Zapraszam do przetestowania aplikacji na moim serwerze demo: https://currencies-app.pszewczyk.pl
