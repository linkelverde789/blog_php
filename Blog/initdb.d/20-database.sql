create user admin with encrypted password 'admin';
create database bdjuegos with owner admin encoding 'utf8';
revoke all privileges on database bdjuegos from public;
grant all privileges on database bdjuegos to admin;
alter database bdjuegos set search_path to juegos;

\connect bdjuegos;
drop schema if exists juegos cascade;
create schema if not exists juegos authorization admin;

create user app with encrypted password 'app';
grant connect on database bdjuegos to app;
grant usage on schema juegos to app;
alter default privileges in schema juegos
    grant select, insert, update, delete on tables to app;
alter default privileges in schema juegos
    grant usage on sequences to app;
