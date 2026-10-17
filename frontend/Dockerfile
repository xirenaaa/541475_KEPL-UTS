# frontend/Dockerfile
# Multi-stage build (Soal 5b)

# Stage 1: Build the Vue.js application with Node.js
FROM node:22-alpine AS build

WORKDIR /app

# Copy package files first for layer caching
COPY package.json package-lock.json ./
RUN npm ci

# Copy application source and build
COPY . .

# Build argument for API URL (injected at build time)
ARG VITE_API_BASE_URL=http://localhost:8000/api
ENV VITE_API_BASE_URL=${VITE_API_BASE_URL}

RUN npm run build

# Stage 2: Serve with Nginx (no node_modules in final image - Soal 5b)
FROM nginx:1.27-alpine

# Copy custom nginx config
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copy built files from build stage
COPY --from=build /app/dist /usr/share/nginx/html

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
