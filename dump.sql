--
-- PostgreSQL database dump
--

-- Dumped from database version 15.2 (Debian 15.2-1.pgdg110+1)
-- Dumped by pg_dump version 15.2 (Debian 15.2-1.pgdg110+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner:
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: privileges; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.privileges (
    id_privilege integer NOT NULL
);


ALTER TABLE public.privileges OWNER TO dbuser;

--
-- Name: privileges_id_privilege_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.privileges_id_privilege_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.privileges_id_privilege_seq OWNER TO dbuser;

--
-- Name: privileges_id_privilege_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.privileges_id_privilege_seq OWNED BY public.privileges.id_privilege;


--
-- Name: users; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users (
                              id_user integer NOT NULL,
                              username character varying(255) NOT NULL,
                              password character varying(255) NOT NULL,
                              id_privilege integer DEFAULT 2 NOT NULL
);


ALTER TABLE public.users OWNER TO dbuser;

--
-- Name: users_data; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users_data (
                                   id_users_data integer NOT NULL,
                                   name character varying(50) NOT NULL,
                                   surname character varying(100) NOT NULL,
                                   id_user integer NOT NULL
);


ALTER TABLE public.users_data OWNER TO dbuser;

--
-- Name: users_data_id_users_data_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.users_data_id_users_data_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_data_id_users_data_seq OWNER TO dbuser;

--
-- Name: users_data_id_users_data_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.users_data_id_users_data_seq OWNED BY public.users_data.id_users_data;


--
-- Name: users_id_user_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.users_id_user_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_user_seq OWNER TO dbuser;

--
-- Name: users_id_user_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.users_id_user_seq OWNED BY public.users.id_user;


--
-- Name: privileges id_privilege; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.privileges ALTER COLUMN id_privilege SET DEFAULT nextval('public.privileges_id_privilege_seq'::regclass);


--
-- Name: users id_user; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users ALTER COLUMN id_user SET DEFAULT nextval('public.users_id_user_seq'::regclass);


--
-- Name: users_data id_users_data; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_data ALTER COLUMN id_users_data SET DEFAULT nextval('public.users_data_id_users_data_seq'::regclass);


--
-- Data for Name: privileges; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.privileges (id_privilege) FROM stdin;
1
2
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.users (id_user, username, password, id_privilege) FROM stdin;
1       kowalski        admin   1
\.


--
-- Data for Name: users_data; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.users_data (id_users_data, name, surname, id_user) FROM stdin;
2       Janusz  Kowalski        1
\.


--
-- Name: privileges_id_privilege_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.privileges_id_privilege_seq', 2, true);


--
-- Name: users_data_id_users_data_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.users_data_id_users_data_seq', 2, true);


--
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.users_id_user_seq', 1, true);


--
-- Name: privileges privileges_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.privileges
    ADD CONSTRAINT privileges_pkey PRIMARY KEY (id_privilege);


--
-- Name: users_data users_data_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_data
    ADD CONSTRAINT users_data_pkey PRIMARY KEY (id_users_data);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_user);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- Name: users_data users_data_users_id_user_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_data
    ADD CONSTRAINT users_data_users_id_user_fk FOREIGN KEY (id_user) REFERENCES public.users(id_user);


--
-- Name: users users_privileges_id_privilege_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_privileges_id_privilege_fk FOREIGN KEY (id_privilege) REFERENCES public.privileges(id_privilege);


--
-- PostgreSQL database dump complete
--
