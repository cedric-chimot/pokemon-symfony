# Utiliser l'image officielle Node.js
FROM node:18

# Créer et définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de React
COPY ./pokemon-react /app

# Installer les dépendances
RUN npm install

# Exposer le port 3000
EXPOSE 3000

# Démarrer l'application React
CMD ["npm", "start"]
