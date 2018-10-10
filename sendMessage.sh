#!/bin/bash
TOKEN="648305229:AAHzvIXfDwFv_9XCgRFpMs-0xA2NTfvKOlc"
CHAT_ID=29280478
TEXT=$1
TELEGRAM="https://api.telegram.org/bot$TOKEN/sendMessage"
curl -s -X POST $TELEGRAM -d chat_id=$CHAT_ID -d text="$TEXT"
