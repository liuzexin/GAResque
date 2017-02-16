#!/bin/bash

(QUEUE=* ./yii queue-task &) >> /dev/null
