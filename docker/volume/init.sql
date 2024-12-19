-- init.sql

-- Создание базы данных nft_test, если она не существует
SELECT 'CREATE DATABASE nft_test'
WHERE NOT EXISTS (SELECT 1 FROM pg_database WHERE datname = 'nft_test');

-- Создание базы данных nft, если она не существует
SELECT 'CREATE DATABASE nft'
WHERE NOT EXISTS (SELECT 1 FROM pg_database WHERE datname = 'nft');