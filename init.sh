#bash

docker build -t activity-log . && docker run -d -p 8080:80 --name activity activity-log
