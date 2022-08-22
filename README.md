
# Docker Volume Permissions Setup

[https://medium.com/@nielssj/docker-volumes-and-file-system-permissions-772c1aee23ca](https://medium.com/@nielssj/docker-volumes-and-file-system-permissions-772c1aee23ca)


chown :1073 queues-in-cake -R
chmod 775 queues-in-cake -R
chmod g+s  queues-in-cake -R

