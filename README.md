# Team chat notifier (Telegram bot)

The backend web app sends notifications buy schedule to your Telegram chat using a JSON setting file. 
>#### Possible use-cases:
>- Work team regular events
>- School/University classes notifications
>- Your regular tasks management help.
> e.t.c..

## How works
It launches every 1-5 minutes by crone, checks current events by JSON setting file and sends notifications to the particular chat using Telegram API if it found en event at current time.
*The app an work with a few chats at the same time.*
>#### Technologies
>- PHP language
>- OOP models
>- Telegram API
>- REST API
>- JSON notation
>- Cron job scheduler
>- GitHub Actions

It works with Apache or Nginx web servers as a REST api app.

