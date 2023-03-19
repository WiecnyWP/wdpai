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


--
-- Name: add_art(character varying, character varying, character varying, character varying); Type: PROCEDURE; Schema: public; Owner: dbuser
--

CREATE PROCEDURE public.add_art(IN p_name character varying, IN p_type character varying, IN p_city character varying, IN p_image character varying)
    LANGUAGE plpgsql
    AS $$
DECLARE
type_exists INTEGER;
    city_exists INTEGER;
    type_id INTEGER;
    city_id INTEGER;
BEGIN
SELECT count(*) INTO type_exists FROM types t WHERE t.type = p_type;
IF type_exists = 0 THEN
        INSERT INTO public.types (type) VALUES (p_type);
        type_id := currval('public.types_id_type_seq');
ELSE
SELECT id_type INTO type_id FROM public.types WHERE type = p_type;
END IF;

SELECT count(*) INTO city_exists FROM cities c WHERE c.city = p_city;
IF city_exists = 0 THEN
        INSERT INTO public.cities (city) VALUES (p_city);
        city_id := currval('public.cities_id_city_seq');
ELSE
SELECT id_city INTO city_id FROM public.cities WHERE city = p_city;
END IF;

INSERT INTO public.arts (id_city, id_type, name, image)
VALUES (city_id, type_id, p_name, p_image);

END;
$$;


ALTER PROCEDURE public.add_art(IN p_name character varying, IN p_type character varying, IN p_city character varying, IN p_image character varying) OWNER TO dbuser;

--
-- Name: add_user(character varying, character varying, character varying, character varying); Type: PROCEDURE; Schema: public; Owner: dbuser
--

CREATE PROCEDURE public.add_user(IN p_name character varying, IN p_surname character varying, IN p_username character varying, IN p_password character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
INSERT INTO public.users_data (name, surname) VALUES (p_name, p_surname);
INSERT INTO public.users (id_user_data, username, password, enabled) VALUES (currval('public.users_data_id_user_data_seq'), p_username, p_password, 1);
END;
$$;


ALTER PROCEDURE public.add_user(IN p_name character varying, IN p_surname character varying, IN p_username character varying, IN p_password character varying) OWNER TO dbuser;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: arts; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.arts (
                             id_art integer NOT NULL,
                             id_city integer NOT NULL,
                             id_type integer NOT NULL,
                             name character varying(200) NOT NULL,
                             image character varying(255) NOT NULL
);


ALTER TABLE public.arts OWNER TO dbuser;

--
-- Name: arts_id_art_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.arts_id_art_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arts_id_art_seq OWNER TO dbuser;

--
-- Name: arts_id_art_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.arts_id_art_seq OWNED BY public.arts.id_art;


--
-- Name: cities; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.cities (
                               id_city integer NOT NULL,
                               city character varying(255) NOT NULL
);


ALTER TABLE public.cities OWNER TO dbuser;

--
-- Name: cities_id_city_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.cities_id_city_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cities_id_city_seq OWNER TO dbuser;

--
-- Name: cities_id_city_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.cities_id_city_seq OWNED BY public.cities.id_city;


--
-- Name: rates; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.rates (
                              id_user integer NOT NULL,
                              id_art integer NOT NULL,
                              rate integer
);


ALTER TABLE public.rates OWNER TO dbuser;

--
-- Name: types; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.types (
                              id_type integer NOT NULL,
                              type character varying(255) NOT NULL
);


ALTER TABLE public.types OWNER TO dbuser;

--
-- Name: types_id_type_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.types_id_type_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.types_id_type_seq OWNER TO dbuser;

--
-- Name: types_id_type_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.types_id_type_seq OWNED BY public.types.id_type;


--
-- Name: users; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users (
                              id_user integer NOT NULL,
                              id_user_data integer NOT NULL,
                              id_user_privilege integer DEFAULT 2 NOT NULL,
                              username character varying(255) NOT NULL,
                              password character varying(255) NOT NULL,
                              enabled integer DEFAULT 2
);


ALTER TABLE public.users OWNER TO dbuser;

--
-- Name: users_data; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users_data (
                                   id_user_data integer NOT NULL,
                                   name character varying(50) NOT NULL,
                                   surname character varying(200) NOT NULL
);


ALTER TABLE public.users_data OWNER TO dbuser;

--
-- Name: users_data_id_user_data_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.users_data_id_user_data_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_data_id_user_data_seq OWNER TO dbuser;

--
-- Name: users_data_id_user_data_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.users_data_id_user_data_seq OWNED BY public.users_data.id_user_data;


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
-- Name: users_privileges; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users_privileges (
    id_user_privilege integer NOT NULL
);


ALTER TABLE public.users_privileges OWNER TO dbuser;

--
-- Name: arts id_art; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.arts ALTER COLUMN id_art SET DEFAULT nextval('public.arts_id_art_seq'::regclass);


--
-- Name: cities id_city; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.cities ALTER COLUMN id_city SET DEFAULT nextval('public.cities_id_city_seq'::regclass);


--
-- Name: types id_type; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.types ALTER COLUMN id_type SET DEFAULT nextval('public.types_id_type_seq'::regclass);


--
-- Name: users id_user; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users ALTER COLUMN id_user SET DEFAULT nextval('public.users_id_user_seq'::regclass);


--
-- Name: users_data id_user_data; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_data ALTER COLUMN id_user_data SET DEFAULT nextval('public.users_data_id_user_data_seq'::regclass);


--
-- Data for Name: arts; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.arts (id_art, id_city, id_type, name, image) FROM stdin;
2       1       1       Michelangelo    Path
\.


--
-- Data for Name: cities; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.cities (id_city, city) FROM stdin;
1       Cracow
2       Warsaw
\.


--
-- Data for Name: rates; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.rates (id_user, id_art, rate) FROM stdin;
1       2       4
\.


--
-- Data for Name: types; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.types (id_type, type) FROM stdin;
3       Antique
2       Painting
1       Sculpture
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.users (id_user, id_user_data, id_user_privilege, username, password, enabled) FROM stdin;
1       1       1       kowalski        admin   2
\.


--
-- Data for Name: users_data; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.users_data (id_user_data, name, surname) FROM stdin;
1       Jan     Kowalski
16      moderator       moderator
\.


--
-- Data for Name: users_privileges; Type: TABLE DATA; Schema: public; Owner: dbuser
--

COPY public.users_privileges (id_user_privilege) FROM stdin;
1
2
\.


--
-- Name: arts_id_art_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.arts_id_art_seq', 13, true);


--
-- Name: cities_id_city_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.cities_id_city_seq', 9, true);


--
-- Name: types_id_type_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.types_id_type_seq', 12, true);


--
-- Name: users_data_id_user_data_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.users_data_id_user_data_seq', 18, true);


--
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.users_id_user_seq', 13, true);


--
-- Name: arts arts_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.arts
    ADD CONSTRAINT arts_pkey PRIMARY KEY (id_art);


--
-- Name: cities cities_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (id_city);


--
-- Name: types types_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.types
    ADD CONSTRAINT types_pkey PRIMARY KEY (id_type);


--
-- Name: users_data users_data_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_data
    ADD CONSTRAINT users_data_pkey PRIMARY KEY (id_user_data);


--
-- Name: users users_id_user_data_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_id_user_data_key UNIQUE (id_user_data);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_user);


--
-- Name: users_privileges users_privileges_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users_privileges
    ADD CONSTRAINT users_privileges_pkey PRIMARY KEY (id_user_privilege);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- Name: arts arts_cities_id_city_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.arts
    ADD CONSTRAINT arts_cities_id_city_fk FOREIGN KEY (id_city) REFERENCES public.cities(id_city);


--
-- Name: arts arts_types_id_type_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.arts
    ADD CONSTRAINT arts_types_id_type_fk FOREIGN KEY (id_type) REFERENCES public.types(id_type);


--
-- Name: rates rates_arts_id_art_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.rates
    ADD CONSTRAINT rates_arts_id_art_fk FOREIGN KEY (id_art) REFERENCES public.arts(id_art);


--
-- Name: rates rates_users_id_user_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.rates
    ADD CONSTRAINT rates_users_id_user_fk FOREIGN KEY (id_user) REFERENCES public.users(id_user);


--
-- Name: users users_users_data_id_user_data_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_users_data_id_user_data_fk FOREIGN KEY (id_user_data) REFERENCES public.users_data(id_user_data) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users users_users_privileges_id_user_privilege_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_users_privileges_id_user_privilege_fk FOREIGN KEY (id_user_privilege) REFERENCES public.users_privileges(id_user_privilege);


--
-- PostgreSQL database dump complete
--
