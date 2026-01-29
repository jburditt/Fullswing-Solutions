FROM nginx:1.29.4-alpine-slim

COPY html /usr/share/nginx/html
# COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80