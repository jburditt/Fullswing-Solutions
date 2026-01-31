provider "docker" {}

resource "docker_image" "nginx" {
  name         = "docker.mirror.hashicorp.services/nginx:1.29.4-alpine-slim"
  keep_locally = false
}

resource "docker_container" "nginx" {
  image = docker_image.nginx.image_id
  name  = "tutorial"
  ports {
    internal = 80
    external = 80
  }
}