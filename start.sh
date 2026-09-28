#!/bin/bash

# Render-এর পোর্ট (ডিফল্ট 10000)
PORT=${PORT:-10000}

# PHP সার্ভার চালু করুন
php -S 0.0.0.0:$PORT -t /app