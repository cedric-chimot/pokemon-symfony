# Utiliser l'image officielle Node.js
FROM node:18

# Définir le répertoire de travail
WORKDIR /app

# Copier uniquement les fichiers package.json et package-lock.json
COPY ./pokemon-react/package*.json ./

# Installer les dépendances
RUN npm install

# Copier le reste de l'application
COPY ./pokemon-react ./

# Exposer le port 3000
EXPOSE 3000

# Activer le mode polling pour le live reload
ENV CHOKIDAR_USEPOLLING=true
ENV WATCHPACK_POLLING=true

# Démarrer l'application React
CMD ["npm", "start"]
