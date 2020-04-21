#!/bin/bash
###########################################
# Run the auto remind PHP script.
# Ideally, this could go in a crontab file like so:
#
# (0-59) (0-23) * * * autorun-autoreminder.sh
#
# WHERE
# (0-59) is any number between 0 and 59 (MINUTE)
# (0-23) is any number between 0 and 23 (HOUR)
#
# We don't care when it's run, so long as it's run,
# once a day.
#
php backend/auto-remind.php