--
-- PostgreSQL database dump
--

\restrict TlAsFSKHzZc93unc8a5A306nlcJUUiLXwCOdsnHpQW0qsM5cerGVq24U8COj5fi

-- Dumped from database version 15.14
-- Dumped by pg_dump version 15.14

-- Started on 2025-12-19 13:10:41

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 248 (class 1259 OID 18532)
-- Name: agenda; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.agenda (
    id integer NOT NULL,
    judul text,
    deskripsi text,
    tanggal date DEFAULT CURRENT_DATE,
    waktu time without time zone,
    nama_kegiatan text
);


ALTER TABLE public.agenda OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 18531)
-- Name: agenda_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agenda_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agenda_id_seq OWNER TO postgres;

--
-- TOC entry 3613 (class 0 OID 0)
-- Dependencies: 247
-- Name: agenda_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agenda_id_seq OWNED BY public.agenda.id;


--
-- TOC entry 246 (class 1259 OID 18518)
-- Name: berita; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.berita (
    id integer NOT NULL,
    judul text NOT NULL,
    konten text NOT NULL,
    tanggal date DEFAULT CURRENT_DATE,
    gambar character varying(255),
    gambar2 character varying(255),
    gambar3 character varying(255)
);


ALTER TABLE public.berita OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 18517)
-- Name: berita_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.berita_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.berita_id_seq OWNER TO postgres;

--
-- TOC entry 3614 (class 0 OID 0)
-- Dependencies: 245
-- Name: berita_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.berita_id_seq OWNED BY public.berita.id;


--
-- TOC entry 214 (class 1259 OID 18050)
-- Name: dosen; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dosen (
    id_dosen integer NOT NULL,
    nama character varying(100),
    gelar character varying(50),
    nip character varying(30),
    nidn character varying(20),
    email character varying(100),
    alamat_kantor text,
    program_studi character varying(100),
    jabatan character varying(100),
    foto character varying(255)
);


ALTER TABLE public.dosen OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 18055)
-- Name: dosen_id_dosen_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dosen_id_dosen_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dosen_id_dosen_seq OWNER TO postgres;

--
-- TOC entry 3615 (class 0 OID 0)
-- Dependencies: 215
-- Name: dosen_id_dosen_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dosen_id_dosen_seq OWNED BY public.dosen.id_dosen;


--
-- TOC entry 237 (class 1259 OID 18181)
-- Name: fasilitasperalatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fasilitasperalatan (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.fasilitasperalatan OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 18180)
-- Name: fasilitasperalatan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fasilitasperalatan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fasilitasperalatan_id_seq OWNER TO postgres;

--
-- TOC entry 3616 (class 0 OID 0)
-- Dependencies: 236
-- Name: fasilitasperalatan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fasilitasperalatan_id_seq OWNED BY public.fasilitasperalatan.id;


--
-- TOC entry 235 (class 1259 OID 18172)
-- Name: fokusriset; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fokusriset (
    id integer NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.fokusriset OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 18171)
-- Name: fokusriset_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fokusriset_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fokusriset_id_seq OWNER TO postgres;

--
-- TOC entry 3617 (class 0 OID 0)
-- Dependencies: 234
-- Name: fokusriset_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fokusriset_id_seq OWNED BY public.fokusriset.id;


--
-- TOC entry 216 (class 1259 OID 18056)
-- Name: jenis_layanan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jenis_layanan (
    id integer NOT NULL,
    nama_layanan character varying(100) NOT NULL
);


ALTER TABLE public.jenis_layanan OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 18059)
-- Name: jenis_layanan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jenis_layanan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jenis_layanan_id_seq OWNER TO postgres;

--
-- TOC entry 3618 (class 0 OID 0)
-- Dependencies: 217
-- Name: jenis_layanan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jenis_layanan_id_seq OWNED BY public.jenis_layanan.id;


--
-- TOC entry 239 (class 1259 OID 18191)
-- Name: kegiatanproyek; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kegiatanproyek (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.kegiatanproyek OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 18190)
-- Name: kegiatanproyek_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.kegiatanproyek_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.kegiatanproyek_id_seq OWNER TO postgres;

--
-- TOC entry 3619 (class 0 OID 0)
-- Dependencies: 238
-- Name: kegiatanproyek_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.kegiatanproyek_id_seq OWNED BY public.kegiatanproyek.id;


--
-- TOC entry 218 (class 1259 OID 18060)
-- Name: layanan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.layanan (
    id_lay integer NOT NULL,
    full_name character varying(150) NOT NULL,
    phone_number character varying(20),
    email character varying(150) NOT NULL,
    detail_kegiatan text,
    jenis_layanan integer,
    tanggal date,
    file_surat character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    status character varying(225) DEFAULT 'pending'::character varying,
    jam_pelaksanaan character varying(20)
);


ALTER TABLE public.layanan OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 18066)
-- Name: layanan_id_lay_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.layanan_id_lay_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.layanan_id_lay_seq OWNER TO postgres;

--
-- TOC entry 3620 (class 0 OID 0)
-- Dependencies: 219
-- Name: layanan_id_lay_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.layanan_id_lay_seq OWNED BY public.layanan.id_lay;


--
-- TOC entry 220 (class 1259 OID 18067)
-- Name: link_sosial; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.link_sosial (
    id_link integer NOT NULL,
    id_dosen integer,
    nama_platform character varying(50),
    url text
);


ALTER TABLE public.link_sosial OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 18072)
-- Name: link_sosial_id_link_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.link_sosial_id_link_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.link_sosial_id_link_seq OWNER TO postgres;

--
-- TOC entry 3621 (class 0 OID 0)
-- Dependencies: 221
-- Name: link_sosial_id_link_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.link_sosial_id_link_seq OWNED BY public.link_sosial.id_link;


--
-- TOC entry 222 (class 1259 OID 18073)
-- Name: mata_kuliah; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mata_kuliah (
    id_mk integer NOT NULL,
    id_dosen integer,
    semester character varying(10),
    nama_mk character varying(150),
    CONSTRAINT mata_kuliah_semester_check CHECK (((semester)::text = ANY (ARRAY[('Ganjil'::character varying)::text, ('Genap'::character varying)::text])))
);


ALTER TABLE public.mata_kuliah OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 18077)
-- Name: mata_kuliah_id_mk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mata_kuliah_id_mk_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.mata_kuliah_id_mk_seq OWNER TO postgres;

--
-- TOC entry 3622 (class 0 OID 0)
-- Dependencies: 223
-- Name: mata_kuliah_id_mk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mata_kuliah_id_mk_seq OWNED BY public.mata_kuliah.id_mk;


--
-- TOC entry 254 (class 1259 OID 18564)
-- Name: media_gambar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.media_gambar (
    id integer NOT NULL,
    jenis character varying(20) NOT NULL,
    id_konten integer NOT NULL,
    file_gambar text NOT NULL,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.media_gambar OWNER TO postgres;

--
-- TOC entry 253 (class 1259 OID 18563)
-- Name: media_gambar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.media_gambar_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.media_gambar_id_seq OWNER TO postgres;

--
-- TOC entry 3623 (class 0 OID 0)
-- Dependencies: 253
-- Name: media_gambar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.media_gambar_id_seq OWNED BY public.media_gambar.id;


--
-- TOC entry 224 (class 1259 OID 18078)
-- Name: open_recruitment; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.open_recruitment (
    id_or integer NOT NULL,
    full_name character varying(150) NOT NULL,
    email_kampus character varying(150) NOT NULL,
    phone_number character varying(20) NOT NULL,
    file_cv character varying(255),
    file_ktm character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    status character varying(225) DEFAULT 'pending'::character varying,
    nim character varying(30)
);


ALTER TABLE public.open_recruitment OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 18084)
-- Name: open_recruitment_id_or_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.open_recruitment_id_or_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.open_recruitment_id_or_seq OWNER TO postgres;

--
-- TOC entry 3624 (class 0 OID 0)
-- Dependencies: 225
-- Name: open_recruitment_id_or_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.open_recruitment_id_or_seq OWNED BY public.open_recruitment.id_or;


--
-- TOC entry 226 (class 1259 OID 18085)
-- Name: pendidikan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pendidikan (
    id_pendidikan integer NOT NULL,
    id_dosen integer,
    jenjang character varying(50),
    jurusan character varying(150),
    universitas character varying(150),
    tahun character varying(20)
);


ALTER TABLE public.pendidikan OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 18088)
-- Name: pendidikan_id_pendidikan_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pendidikan_id_pendidikan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pendidikan_id_pendidikan_seq OWNER TO postgres;

--
-- TOC entry 3625 (class 0 OID 0)
-- Dependencies: 227
-- Name: pendidikan_id_pendidikan_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pendidikan_id_pendidikan_seq OWNED BY public.pendidikan.id_pendidikan;


--
-- TOC entry 251 (class 1259 OID 18546)
-- Name: pengumuman; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengumuman (
    id integer NOT NULL,
    judul text NOT NULL,
    konten text,
    tanggal date DEFAULT CURRENT_DATE,
    gambar character varying(255),
    gambar2 character varying(255),
    gambar3 character varying(255)
);


ALTER TABLE public.pengumuman OWNER TO postgres;

--
-- TOC entry 250 (class 1259 OID 18545)
-- Name: pengumuman_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengumuman_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pengumuman_id_seq OWNER TO postgres;

--
-- TOC entry 3626 (class 0 OID 0)
-- Dependencies: 250
-- Name: pengumuman_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengumuman_id_seq OWNED BY public.pengumuman.id;


--
-- TOC entry 241 (class 1259 OID 18200)
-- Name: perkuliahanterkait; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perkuliahanterkait (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.perkuliahanterkait OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 18199)
-- Name: perkuliahanterkait_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.perkuliahanterkait_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.perkuliahanterkait_id_seq OWNER TO postgres;

--
-- TOC entry 3627 (class 0 OID 0)
-- Dependencies: 240
-- Name: perkuliahanterkait_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.perkuliahanterkait_id_seq OWNED BY public.perkuliahanterkait.id;


--
-- TOC entry 233 (class 1259 OID 18163)
-- Name: profilelab; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.profilelab (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.profilelab OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 18162)
-- Name: profilelab_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.profilelab_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.profilelab_id_seq OWNER TO postgres;

--
-- TOC entry 3628 (class 0 OID 0)
-- Dependencies: 232
-- Name: profilelab_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.profilelab_id_seq OWNED BY public.profilelab.id;


--
-- TOC entry 228 (class 1259 OID 18089)
-- Name: publikasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.publikasi (
    id_publikasi integer NOT NULL,
    id_dosen integer,
    jenis_publikasi character varying(50),
    link_publikasi text NOT NULL,
    CONSTRAINT publikasi_jenis_publikasi_check CHECK (((jenis_publikasi)::text = ANY (ARRAY[('Scopus'::character varying)::text, ('Google Scholar'::character varying)::text, ('Sinta'::character varying)::text])))
);


ALTER TABLE public.publikasi OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 18095)
-- Name: publikasi_id_publikasi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.publikasi_id_publikasi_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.publikasi_id_publikasi_seq OWNER TO postgres;

--
-- TOC entry 3629 (class 0 OID 0)
-- Dependencies: 229
-- Name: publikasi_id_publikasi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.publikasi_id_publikasi_seq OWNED BY public.publikasi.id_publikasi;


--
-- TOC entry 267 (class 1259 OID 18633)
-- Name: roadmap; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roadmap (
    id integer NOT NULL,
    tahun integer NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.roadmap OWNER TO postgres;

--
-- TOC entry 266 (class 1259 OID 18632)
-- Name: roadmap_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roadmap_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roadmap_id_seq OWNER TO postgres;

--
-- TOC entry 3630 (class 0 OID 0)
-- Dependencies: 266
-- Name: roadmap_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roadmap_id_seq OWNED BY public.roadmap.id;


--
-- TOC entry 263 (class 1259 OID 18605)
-- Name: sarana_prasarana; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sarana_prasarana (
    id integer NOT NULL,
    nama_ruangan character varying(255) NOT NULL,
    deskripsi text,
    foto_url character varying(500)
);


ALTER TABLE public.sarana_prasarana OWNER TO postgres;

--
-- TOC entry 262 (class 1259 OID 18604)
-- Name: sarana_prasarana_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sarana_prasarana_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sarana_prasarana_id_seq OWNER TO postgres;

--
-- TOC entry 3631 (class 0 OID 0)
-- Dependencies: 262
-- Name: sarana_prasarana_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sarana_prasarana_id_seq OWNED BY public.sarana_prasarana.id;


--
-- TOC entry 257 (class 1259 OID 18578)
-- Name: sejarah; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sejarah (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    deskripsi text NOT NULL
);


ALTER TABLE public.sejarah OWNER TO postgres;

--
-- TOC entry 256 (class 1259 OID 18577)
-- Name: sejarah_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sejarah_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sejarah_id_seq OWNER TO postgres;

--
-- TOC entry 3632 (class 0 OID 0)
-- Dependencies: 256
-- Name: sejarah_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sejarah_id_seq OWNED BY public.sejarah.id;


--
-- TOC entry 261 (class 1259 OID 18596)
-- Name: struktur_organisasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.struktur_organisasi (
    id integer NOT NULL,
    jabatan character varying(255) NOT NULL,
    nama character varying(255) NOT NULL,
    foto character varying(500)
);


ALTER TABLE public.struktur_organisasi OWNER TO postgres;

--
-- TOC entry 260 (class 1259 OID 18595)
-- Name: struktur_organisasi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.struktur_organisasi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.struktur_organisasi_id_seq OWNER TO postgres;

--
-- TOC entry 3633 (class 0 OID 0)
-- Dependencies: 260
-- Name: struktur_organisasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.struktur_organisasi_id_seq OWNED BY public.struktur_organisasi.id;


--
-- TOC entry 269 (class 1259 OID 18642)
-- Name: tenaga_kependidikan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tenaga_kependidikan (
    id integer NOT NULL,
    nama_pegawai character varying(150) NOT NULL,
    deskripsi text,
    jabatan character varying(255)
);


ALTER TABLE public.tenaga_kependidikan OWNER TO postgres;

--
-- TOC entry 268 (class 1259 OID 18641)
-- Name: tenaga_kependidikan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tenaga_kependidikan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tenaga_kependidikan_id_seq OWNER TO postgres;

--
-- TOC entry 3634 (class 0 OID 0)
-- Dependencies: 268
-- Name: tenaga_kependidikan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tenaga_kependidikan_id_seq OWNED BY public.tenaga_kependidikan.id;


--
-- TOC entry 265 (class 1259 OID 18615)
-- Name: tenaga_pengajar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tenaga_pengajar (
    id integer NOT NULL,
    nama_dosen character varying(255) NOT NULL,
    nidn character varying(50),
    jabatan character varying(50),
    foto_url character varying(500)
);


ALTER TABLE public.tenaga_pengajar OWNER TO postgres;

--
-- TOC entry 264 (class 1259 OID 18614)
-- Name: tenaga_pengajar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tenaga_pengajar_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tenaga_pengajar_id_seq OWNER TO postgres;

--
-- TOC entry 3635 (class 0 OID 0)
-- Dependencies: 264
-- Name: tenaga_pengajar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tenaga_pengajar_id_seq OWNED BY public.tenaga_pengajar.id;


--
-- TOC entry 243 (class 1259 OID 18445)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    nama_lengkap character varying(100),
    username character varying(50),
    password character varying(255),
    role character varying(50) DEFAULT 'admin'::character varying
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 18444)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 3636 (class 0 OID 0)
-- Dependencies: 242
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 244 (class 1259 OID 18453)
-- Name: v_dosen_detail_halaman; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_dosen_detail_halaman AS
 SELECT d.id_dosen,
    d.nama,
    d.gelar,
    d.nip,
    d.nidn,
    d.email,
    d.alamat_kantor,
    d.program_studi,
    d.jabatan,
    d.foto,
    ( SELECT json_agg(mg.nama_mk) AS json_agg
           FROM public.mata_kuliah mg
          WHERE ((mg.id_dosen = d.id_dosen) AND ((mg.semester)::text = 'Ganjil'::text))) AS mk_semester_ganjil,
    ( SELECT json_agg(mg.nama_mk) AS json_agg
           FROM public.mata_kuliah mg
          WHERE ((mg.id_dosen = d.id_dosen) AND ((mg.semester)::text = 'Genap'::text))) AS mk_semester_genap,
    ( SELECT json_agg(json_build_object('jenjang', p.jenjang, 'jurusan', p.jurusan, 'universitas', p.universitas, 'tahun', p.tahun)) AS json_agg
           FROM public.pendidikan p
          WHERE (p.id_dosen = d.id_dosen)) AS riwayat_pendidikan,
    ( SELECT json_agg(json_build_object('jenis', pub.jenis_publikasi, 'link', pub.link_publikasi)) AS json_agg
           FROM public.publikasi pub
          WHERE (pub.id_dosen = d.id_dosen)) AS publikasi,
    ( SELECT json_agg(json_build_object('platform', ls.nama_platform, 'url', ls.url)) AS json_agg
           FROM public.link_sosial ls
          WHERE (ls.id_dosen = d.id_dosen)) AS link_sosial
   FROM public.dosen d;


ALTER TABLE public.v_dosen_detail_halaman OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 18541)
-- Name: view_agenda; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_agenda AS
 SELECT agenda.id,
    agenda.judul,
    agenda.deskripsi,
    agenda.tanggal,
    agenda.waktu,
    agenda.nama_kegiatan
   FROM public.agenda
  ORDER BY agenda.tanggal DESC;


ALTER TABLE public.view_agenda OWNER TO postgres;

--
-- TOC entry 255 (class 1259 OID 18573)
-- Name: view_berita; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_berita AS
 SELECT berita.id,
    berita.judul,
    berita.konten,
    berita.gambar,
    berita.tanggal
   FROM public.berita
  ORDER BY berita.tanggal DESC;


ALTER TABLE public.view_berita OWNER TO postgres;

--
-- TOC entry 252 (class 1259 OID 18555)
-- Name: view_pengumuman; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_pengumuman AS
 SELECT pengumuman.id,
    pengumuman.judul,
    pengumuman.konten,
    pengumuman.tanggal
   FROM public.pengumuman
  ORDER BY pengumuman.tanggal DESC;


ALTER TABLE public.view_pengumuman OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 18154)
-- Name: visi_misi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visi_misi (
    id integer NOT NULL,
    visi text NOT NULL,
    misi text NOT NULL
);


ALTER TABLE public.visi_misi OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 18153)
-- Name: visi_misi_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.visi_misi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visi_misi_id_seq OWNER TO postgres;

--
-- TOC entry 3637 (class 0 OID 0)
-- Dependencies: 230
-- Name: visi_misi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visi_misi_id_seq OWNED BY public.visi_misi.id;


--
-- TOC entry 259 (class 1259 OID 18587)
-- Name: visi_misi_tujuan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visi_misi_tujuan (
    id integer NOT NULL,
    visi text NOT NULL,
    misi text NOT NULL,
    tujuan text NOT NULL
);


ALTER TABLE public.visi_misi_tujuan OWNER TO postgres;

--
-- TOC entry 258 (class 1259 OID 18586)
-- Name: visi_misi_tujuan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.visi_misi_tujuan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visi_misi_tujuan_id_seq OWNER TO postgres;

--
-- TOC entry 3638 (class 0 OID 0)
-- Dependencies: 258
-- Name: visi_misi_tujuan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visi_misi_tujuan_id_seq OWNED BY public.visi_misi_tujuan.id;


--
-- TOC entry 3336 (class 2604 OID 18535)
-- Name: agenda id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agenda ALTER COLUMN id SET DEFAULT nextval('public.agenda_id_seq'::regclass);


--
-- TOC entry 3334 (class 2604 OID 18521)
-- Name: berita id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.berita ALTER COLUMN id SET DEFAULT nextval('public.berita_id_seq'::regclass);


--
-- TOC entry 3314 (class 2604 OID 18145)
-- Name: dosen id_dosen; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen ALTER COLUMN id_dosen SET DEFAULT nextval('public.dosen_id_dosen_seq'::regclass);


--
-- TOC entry 3329 (class 2604 OID 18184)
-- Name: fasilitasperalatan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fasilitasperalatan ALTER COLUMN id SET DEFAULT nextval('public.fasilitasperalatan_id_seq'::regclass);


--
-- TOC entry 3328 (class 2604 OID 18175)
-- Name: fokusriset id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fokusriset ALTER COLUMN id SET DEFAULT nextval('public.fokusriset_id_seq'::regclass);


--
-- TOC entry 3315 (class 2604 OID 18146)
-- Name: jenis_layanan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenis_layanan ALTER COLUMN id SET DEFAULT nextval('public.jenis_layanan_id_seq'::regclass);


--
-- TOC entry 3330 (class 2604 OID 18194)
-- Name: kegiatanproyek id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kegiatanproyek ALTER COLUMN id SET DEFAULT nextval('public.kegiatanproyek_id_seq'::regclass);


--
-- TOC entry 3316 (class 2604 OID 18147)
-- Name: layanan id_lay; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.layanan ALTER COLUMN id_lay SET DEFAULT nextval('public.layanan_id_lay_seq'::regclass);


--
-- TOC entry 3319 (class 2604 OID 18148)
-- Name: link_sosial id_link; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.link_sosial ALTER COLUMN id_link SET DEFAULT nextval('public.link_sosial_id_link_seq'::regclass);


--
-- TOC entry 3320 (class 2604 OID 18149)
-- Name: mata_kuliah id_mk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mata_kuliah ALTER COLUMN id_mk SET DEFAULT nextval('public.mata_kuliah_id_mk_seq'::regclass);


--
-- TOC entry 3340 (class 2604 OID 18567)
-- Name: media_gambar id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media_gambar ALTER COLUMN id SET DEFAULT nextval('public.media_gambar_id_seq'::regclass);


--
-- TOC entry 3321 (class 2604 OID 18150)
-- Name: open_recruitment id_or; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.open_recruitment ALTER COLUMN id_or SET DEFAULT nextval('public.open_recruitment_id_or_seq'::regclass);


--
-- TOC entry 3324 (class 2604 OID 18151)
-- Name: pendidikan id_pendidikan; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendidikan ALTER COLUMN id_pendidikan SET DEFAULT nextval('public.pendidikan_id_pendidikan_seq'::regclass);


--
-- TOC entry 3338 (class 2604 OID 18549)
-- Name: pengumuman id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumuman ALTER COLUMN id SET DEFAULT nextval('public.pengumuman_id_seq'::regclass);


--
-- TOC entry 3331 (class 2604 OID 18203)
-- Name: perkuliahanterkait id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perkuliahanterkait ALTER COLUMN id SET DEFAULT nextval('public.perkuliahanterkait_id_seq'::regclass);


--
-- TOC entry 3327 (class 2604 OID 18166)
-- Name: profilelab id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profilelab ALTER COLUMN id SET DEFAULT nextval('public.profilelab_id_seq'::regclass);


--
-- TOC entry 3325 (class 2604 OID 18152)
-- Name: publikasi id_publikasi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publikasi ALTER COLUMN id_publikasi SET DEFAULT nextval('public.publikasi_id_publikasi_seq'::regclass);


--
-- TOC entry 3347 (class 2604 OID 18636)
-- Name: roadmap id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roadmap ALTER COLUMN id SET DEFAULT nextval('public.roadmap_id_seq'::regclass);


--
-- TOC entry 3345 (class 2604 OID 18608)
-- Name: sarana_prasarana id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sarana_prasarana ALTER COLUMN id SET DEFAULT nextval('public.sarana_prasarana_id_seq'::regclass);


--
-- TOC entry 3342 (class 2604 OID 18581)
-- Name: sejarah id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sejarah ALTER COLUMN id SET DEFAULT nextval('public.sejarah_id_seq'::regclass);


--
-- TOC entry 3344 (class 2604 OID 18599)
-- Name: struktur_organisasi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.struktur_organisasi ALTER COLUMN id SET DEFAULT nextval('public.struktur_organisasi_id_seq'::regclass);


--
-- TOC entry 3348 (class 2604 OID 18645)
-- Name: tenaga_kependidikan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tenaga_kependidikan ALTER COLUMN id SET DEFAULT nextval('public.tenaga_kependidikan_id_seq'::regclass);


--
-- TOC entry 3346 (class 2604 OID 18618)
-- Name: tenaga_pengajar id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tenaga_pengajar ALTER COLUMN id SET DEFAULT nextval('public.tenaga_pengajar_id_seq'::regclass);


--
-- TOC entry 3332 (class 2604 OID 18448)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3326 (class 2604 OID 18157)
-- Name: visi_misi id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi_misi ALTER COLUMN id SET DEFAULT nextval('public.visi_misi_id_seq'::regclass);


--
-- TOC entry 3343 (class 2604 OID 18590)
-- Name: visi_misi_tujuan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi_misi_tujuan ALTER COLUMN id SET DEFAULT nextval('public.visi_misi_tujuan_id_seq'::regclass);


--
-- TOC entry 3589 (class 0 OID 18532)
-- Dependencies: 248
-- Data for Name: agenda; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.agenda VALUES (1, NULL, 'Jadwal Layanan Tahun Ajaran 2025/2027:
Berikut Jadwal yang telah kami tentukan:', NULL, NULL, NULL);
INSERT INTO public.agenda VALUES (27, NULL, 'workshop', '2025-12-26', '10:03:00', 'workshop');
INSERT INTO public.agenda VALUES (22, NULL, 'demo tugas akhir', '2025-06-18', '14:00:00', 'Pengujian Tugas Akhir');
INSERT INTO public.agenda VALUES (21, NULL, 'webinar jurusan TI', '2025-06-15', '10:00:00', 'Webinar Keamanan Siber');
INSERT INTO public.agenda VALUES (20, NULL, 'Pengujian perangkat lunak oleh dosen TI', '2025-06-12', '13:00:00', 'Pelatihan Perangkat Lunak');
INSERT INTO public.agenda VALUES (19, NULL, 'workshop Artificial Intellegence', '2025-06-10', '09:00:00', 'Workshop AI');


--
-- TOC entry 3587 (class 0 OID 18518)
-- Dependencies: 246
-- Data for Name: berita; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.berita VALUES (3, 'Mahasiswa Jurusan Teknologi Informasi Politeknik Negeri Malang Raih Juara 3 Hackathon – IT Fest 2025', 'Kabar membanggakan datang dari Jurusan Teknologi Informasi Politeknik Negeri Malang!
Tim terbaik kita berhasil meraih Juara 3 dalam kompetisi Hackathon – IT Fest 2025, yang diselenggarakan oleh Himpunan Jurusan Teknologi Informasi Politeknik Negeri Samarinda. Ajang ini menjadi wadah bagi para inovator muda untuk menciptakan 
solusi digital yang kreatif dan berdampak nyata di era transformasi teknologi saat ini. 
Anggota Tim:
1. Ananda Priya Yustira (244107020131) / TI 2A
2. Wandi (244107020003) / TI 2B
3. Laksamana Arya Putra (244107020021) / TI 2A
Pembimbing : Pramana Yoga Saputra, S.Kom., MMT.
Dengan kerja sama yang solid, ide brilian, dan semangat pantang menyerah, tim ini membuktikan bahwa mahasiswa TI mampu bersaing secara nasional dan menunjukkan potensi luar biasa dalam bidang teknologi. 

Selamat kepada para juara atas dedikasi dan perjuangannya!
Teruslah belajar, berinovasi, dan menginspirasi.
Bagi seluruh mahasiswa Jurusan Teknologi Informasi, jadikan prestasi ini sebagai 
motivasi untuk terus berkarya dan membangun masa depan teknologi yang lebih baik!', '2024-10-05', 'img/berita3.png', NULL, NULL);
INSERT INTO public.berita VALUES (1, 'Mahasiswa D4 Sistem Informasi Bisnis Jurusan Teknologi Informasi meraih Juara 1 ajang RK INK BLEND COMPETITION!', 'Pada ajang RK INK BLEND COMPETITION yang diselenggarakan oleh RumahKIPK Universitas Siliwangi, mahasiswa inspiratif kami, Farel Maryam Laila Hajiri (D4-SIB/2341760028), sukses menorehkan hasil terbaik dengan meraih Juara 1 Lomba Esai. Kemenangan ini menjadi bukti nyata bahwa kemampuan literasi ilmiah mahasiswa SIB mampu bersaing dan unggul di tingkat nasional.
Dalam kompetisi ini, Farel menampilkan esai dengan ide yang kuat, penyusunan argumen yang logis, serta analisis yang matang sehingga mendapatkan apresiasi tinggi dari dewan juri. Prestasi tersebut menunjukkan bahwa kemampuan mahasiswa tidak hanya terbatas pada dunia teknologi dan bisnis, tetapi juga mencakup kemampuan menulis, berpikir kritis, dan menyampaikan gagasan secara efektif.
Keberhasilan ini tentunya tidak terlepas dari dukungan dan bimbingan penuh dari Ibu Farida Ulfa, S.Pd., M.Pd., selaku dosen pembimbing. Dengan arahan beliau, Farel mampu memperdalam isi esai, memperbaiki struktur tulisan, serta memastikan setiap gagasan tersampaikan dengan jelas dan berbobot. Dedikasi beliau memberikan kontribusi besar dalam keberhasilan karya ini.
Semoga kemenangan ini dapat menjadi inspirasi bagi seluruh mahasiswa untuk terus mengasah kemampuan, mengikuti berbagai kompetisi, dan menciptakan karya yang berdampak. 
Selamat kepada Farel atas pencapaian luar biasa ini! Teruslah berkarya dan jadilah representasi terbaik bagi kampus dalam berbagai ajang prestasi.', '2025-10-10', 'img/berita1.png', NULL, NULL);
INSERT INTO public.berita VALUES (4, 'Prestasi Gemilang! Mahasiswa Prodi D4 Sistem Informasi Bisnis Juara di Entrepreneurs Festival 2025 Politeknik Negeri Malang.', 'Civitas Akademika Jurusan Teknologi Informasi, khususnya Program Studi D4 Sistem Informasi Bisnis (SIB), dengan bangga mengumumkan prestasi luar biasa yang diraih oleh mahasiswa angkatan 2023 dalam ajang bergengsi Entrepreneurs Festival 2025 
by UPA PKK Politeknik Negeri Malang (Polinema).
Mahasiswa D4 SIB Angkatan 2023 berhasil menunjukkan kreativitas dan kemampuan wirausaha digital mereka dengan memborong dua gelar juara sekaligus di dua kategori lomba yang berbeda.
Juara 1 Lomba Poster
Karya inovatif tim ini berhasil meraih posisi puncak sebagai Juara 1 Lomba Poster.
Berikut nama mahasiswa Pemenang Juara 1 Lomba Poster :
Satria Rakhmadani (D4 SIB Angkatan 2023)
Farel Maryam Laila Hajiri (D4 SIB Angkatan 2023)

Juara 3 & Favorit Lomba Digital Marketing Video
Tim ini meraih prestasi membanggakan Juara 3 dan sekaligus menjadi pemenang Lomba Favorit di kategori Digital Marketing Video.
Berikut nama mahasiswa Juara 3 & Favorit Lomba Digital Marketing Video :
Farel Maryam Laila Hajiri (D4 SIB Angkatan 2023)
Adinda Ivanka Maysanda Putri (D4 SIB Angkatan 2023)
Dinarul Lailil Mubarokah (D4 SIB Angkatan 2023)

Apresiasi dan ucapan Terima Kasih kepada Dosen Pembimbing Ibu Farida Ulfa, S.Pd., M.Pd. atas dedikasinya telah membimbing tim dari D4 SIB 2023.
Keluarga Besar Program Studi D4 Sistem Informasi Bisnis mengucapkan “Selamat dan sukses” atas prestasi gemilang yang telah diraih! Semoga kemenangan ini menjadi motivasi untuk terus berkarya, berinovasi, dan membawa nama baik program studi serta 
almamater di kancah nasional maupun internasional.', '2025-03-13', 'img/berita4.png', NULL, NULL);
INSERT INTO public.berita VALUES (2, 'Jurusan Teknologi Informasi Politeknik Negeri Malang melaksanakan kegiatan dengan tema “AI Ready ASEAN untuk Siswa”', 'Jurusan Teknologi Informasi Politeknik Negeri Malang melaksanakan kegiatan “AI Ready ASEAN untuk Siswa” pada Selasa, 11 November 2025, bertempat di Ruang LSI Lantai 6. Kegiatan ini merupakan inisiatif pembelajaran yang bertujuan 
untuk menyiapkan generasi muda agar lebih memahami dan siap menghadapi perkembangan pesat teknologi Artificial Intelligence (AI) di kawasan ASEAN. Acara ini menghadirkan lima narasumber inspiratif, yaitu Dian Anita, Nunuk Alsa, Rini Kartini, 
Eko Widianto, serta Anak Agung Ayu selaku Korwil Mafindo Malang sekaligus Trainer AI Ready. Para pembicara berbagi wawasan tentang pentingnya literasi digital, etika penggunaan AI, dan peluang karier di bidang teknologi yang semakin berkembang.
Kegiatan ini diikuti oleh 100 mahasiswa Jurusan Teknologi Informasi Politeknik Negeri Malang yang antusias mengikuti setiap sesi pelatihan dan diskusi. Melalui kegiatan ini, mahasiswa tidak hanya mendapatkan pengetahuan teoritis, 
tetapi juga pengalaman praktis dalam memahami konsep AI secara komprehensif.

Melalui program AI Ready ASEAN untuk Siswa, diharapkan mahasiswa Jurusan Teknologi Informasi Politeknik Negeri Malang mampu menjadi generasi digital yang inovatif, cerdas, dan berdaya saing tinggi di era transformasi teknologi global.', '2024-02-13', 'img/berita2.png', NULL, NULL);
INSERT INTO public.berita VALUES (9, 'Jurusan Teknologi Informasi Politeknik Negeri Malang berhasil meraih juara 2 umum pada Kompetensi Mahasiswa Informatika Politeknik Nasional (KMIPN) 2025 yang berlangsung pada tanggal 13 – 16 Oktober 2025 di Politeknik Negeri Padang dengan perolehan 1 emas, 1 perak dan 1 perunggu', 'Dengan penuh kebanggaan dan rasa syukur, Jurusan Teknologi Informasi Politeknik Negeri Malang (TI Polinema) kembali menorehkan prestasi gemilang di tingkat nasional! Selamat kepada seluruh tim dan pembimbing atas keberhasilan luar biasa meraih Juara 2 Umum pada ajang 
Kompetensi Mahasiswa Informatika Politeknik Nasional (KMIPN) 2025, yang diselenggarakan pada 13–16 Oktober 2025 di Politeknik Negeri Padang.
Pada ajang bergengsi tersebut, Jurusan Teknologi Informasi berhasil memperoleh 1 medali emas, 1 medali perak, dan 1 medali perunggu. Adapun rincian prestasi yang diraih antara lain:
🥇 Juara 1 Cipta Inovasi – Tim 19Million (Abdullah Shamil Basayev, Dwi Ahmad Khairy, Yefta Octavianus Santo) – Pembimbing: Muhammad Afif Hendrawan, S.Kom., MT
🥈 Juara 2 Bidang E-Government – Tim Gatranova (Alyfa Zahra Qurrota Aini, Rafi Abiyyu Airlangga, Savero Athallah Hardiana Putra) – Pembimbing: Dika Rizky Yunianto, S.Kom., M.Kom
🥈 Juara 2 Inovasi Kerjasama Tim Bidang Cipta Inovasi – Tim LLMForAutism – Pembimbing: Muhammad Afif Hendrawan, S.Kom., MT
🥉 Juara 3 Bidang Keamanan Siber – Tim Sembarang Wes – Pembimbing: Dika Rizky Yunianto, S.Kom., M.Kom
🏅 Juara 1 Collaboration Team Keamanan Siber – Tim Team Othy Ronal – Pembimbing: Vipkas Al Hadid Firdaus, ST., MT
🏅 Juara 1 Presentasi Hackathon – Tim Masukkan Nama Tim – Pembimbing: Yoppy Yunhasnawa, S.ST., M.Sc.
🏅 Juara 1 Implementasi Sistem IoT – Tim Pigora – Pembimbing: Dr. Ulla Delfana Rosiani, ST., MT', '2025-12-07', 'img/berita6.png', NULL, NULL);
INSERT INTO public.berita VALUES (5, 'Kuliah Tamu JTI Polinema Bersama Nortis Academy Membuka Wawasan tentang “AI Opportunity Learning”', ' Jurusan Teknologi Informasi Politeknik Negeri Malang (JTI Polinema) kembali menghadirkan kuliah tamu yang inspiratif bersama Nortis Academy. Acara ini dilaksanakan pada hari Kamis, 4 September 2025, bertempat di Auditorium Gedung Teknik Sipil lantai 8.
Dengan mengusung tema “AI Opportunity Learning”, kuliah tamu ini memberikan wawasan kepada mahasiswa mengenai peluang, tantangan, dan perkembangan terkini dalam bidang kecerdasan buatan (Artificial Intelligence/AI). Topik ini sejalan dengan kebutuhan industri digital yang 
terus berkembang pesat dan semakin menuntut kompetensi sumber daya manusia di bidang teknologi berbasis AI. Acara dibuka dengan sambutan dari Ketua Jurusan Teknologi Informasi Polinema yang menekankan pentingnya mahasiswa memahami perkembangan teknologi mutakhir. Para 
narasumber dari Nortis Academy kemudian membagikan pengalaman praktis, studi kasus, serta strategi implementasi AI dalam dunia kerja maupun penelitian. Mahasiswa terlihat sangat antusias mengikuti materi, terbukti dari banyaknya pertanyaan yang diajukan saat sesi diskusi. 
Diharapkan, melalui kuliah tamu ini mahasiswa Jurusan Teknologi Informasi Polinema dapat lebih siap menghadapi era digital, sekaligus mampu memanfaatkan peluang besar yang ditawarkan teknologi AI dalam berbagai sektor industri. Kuliah tamu bersama Nortis Academy ini menjadi 
bagian dari komitmen Jurusan Teknologi Informasi Polinema dalam memperkuat kerjasama antara dunia akademik dengan mitra industri, serta mencetak generasi muda yang inovatif, adaptif, dan siap berkontribusi di era kecerdasan buatan.', '2025-06-26', 'img/berita5.png', NULL, NULL);
INSERT INTO public.berita VALUES (18, 'Pelantikan Ketua Jurusan dan Sekretaris Jurusan Penggantian Antar Waktu Periode 2023 – 2025', 'Menjadi momentum penting bagi Jurusan Teknologi Informasi dengan terselenggaranya kegiatan pelantikan Ketua Jurusan dan Sekretaris Jurusan Teknologi Informasi dalam rangka penggantian antar waktu periode 2023–2027. Kegiatan ini menandai komitmen berkelanjutan jurusan dalam menjaga kesinambungan kepemimpinan serta meningkatkan tata kelola akademik dan organisasi yang profesional.

Pada kesempatan tersebut, Ibu Mungki Astiningrum, S.T., M.Kom. resmi dilantik sebagai Ketua Jurusan Teknologi Informasi. Dengan pengalaman, kompetensi, dan dedikasi yang dimiliki, diharapkan kepemimpinan beliau mampu membawa jurusan semakin adaptif terhadap perkembangan teknologi, inovatif dalam pembelajaran, serta unggul dalam riset dan pengabdian kepada masyarakat. Visi yang kuat dan kepemimpinan yang kolaboratif menjadi bekal penting untuk mendorong capaian strategis jurusan ke depan.

Selain itu, Bapak Luqman Affandi, S.Kom., MMSI juga resmi dilantik sebagai Sekretaris Jurusan Teknologi Informasi. Peran strategis sekretaris jurusan diharapkan dapat memperkuat koordinasi internal, mendukung efektivitas administrasi akademik, serta memastikan seluruh program dan kebijakan jurusan berjalan secara tertib, transparan, dan berorientasi pada mutu.

Pelantikan ini bukan sekadar seremonial, melainkan wujud kepercayaan institusi terhadap kepemimpinan baru untuk mengemban amanah dan tanggung jawab besar. Dengan sinergi seluruh sivitas akademika, diharapkan Jurusan Teknologi Informasi terus berkembang, berprestasi, dan berkontribusi nyata dalam mencetak lulusan yang kompeten, berkarakter, dan siap bersaing di era transformasi digital. Semoga kepemimpinan yang baru membawa semangat, inovasi, dan kemajuan berkelanjutan bagi Jurusan Teknologi Informasi.', '2023-03-13', 'img/berita_1765965546_Screenshot 2025-12-17 165717.png', NULL, NULL);
INSERT INTO public.berita VALUES (19, 'JTI Polinema melaksanakan rapat Jurusan Pergantian Pimpinan Antar Waktu', 'Jurusan Teknologi Informasi Politeknik Negeri Malang menyelenggarakan Rapat Pergantian Pimpinan Antar Waktu yang bertempat di Ruang Auditorium Jurusan Teknologi Informasi. Kegiatan ini dihadiri oleh Kepala Jurusan, Sekretaris Jurusan, Koordinator Program Studi D4 Teknik Informatika, Koordinator Program Studi D4 Sistem Informasi Bisnis, Koordinator Program Studi D2 Pengembangan Piranti Lunak Situs, serta seluruh Bapak/Ibu Dosen Jurusan Teknologi Informasi.

Agenda rapat dilaksanakan sebagai tindak lanjut dari ketentuan Statuta Polinema Pasal 61 ayat (3) yang menyatakan bahwa ketua jurusan, sekretaris jurusan, dan unsur pimpinan jurusan lainnya dapat diberhentikan sebelum masa jabatannya berakhir apabila yang bersangkutan diangkat dalam jabatan negeri yang lain. Hal ini terjadi karena Kepala Jurusan Teknologi Informasi memperoleh amanah baru sebagai Wakil Direktur IV Politeknik Negeri Malang, sehingga secara resmi dapat diberhentikan dari jabatannya sebelum periode kepemimpinan berakhir.

Sebagai langkah memastikan kesinambungan tata kelola jurusan, rapat memutuskan bahwa jabatan Kepala Jurusan Teknologi Informasi selanjutnya diisi oleh Ibu Mungki Astiningrum, ST., M.Kom., yang sebelumnya menjabat sebagai Sekretaris Jurusan. Sementara itu, posisi Sekretaris Jurusan diputuskan melalui musyawarah bersama dan resmi diberikan kepada Bapak Luqman Affandi, S.Kom., MMSI, yang sebelumnya menjabat sebagai Ketua Program Studi D3 Manajemen Informatika PSDKU Pamekasan.

Dengan terisinya struktur kepemimpinan yang baru, diharapkan Jurusan Teknologi Informasi semakin solid dan mampu melanjutkan berbagai program strategis dengan lebih optimal.', '2022-06-30', 'img/berita_1765965700_Screenshot 2025-12-17 170032.png', NULL, NULL);
INSERT INTO public.berita VALUES (21, 'Mahasiswa Jurusan Teknologi Informasi kembali menorehkan prestasi membanggakan dalam ajang CREANOMIC 2025 yang diselenggarakan oleh BEM Fakultas Vokasi Universitas Brawijaya.', '🏆 Selamat untuk Tim Delta Dev – Juara 1 CREANOMIC 2025! 🏆

Kabar membanggakan kembali datang dari Jurusan Teknologi Informasi Politeknik Negeri Malang! Tim Delta Dev berhasil meraih Juara 1 dalam ajang CREANOMIC 2025, kompetisi bergengsi yang diselenggarakan oleh BEM Fakultas Vokasi Universitas Brawijaya.

Tim hebat ini beranggotakan:
👨‍💻 Kareza Maulana Iskhak (D-IV SIB 1F / 254107060104)
👨‍💻 Lucky Satria Utama (D-IV SIB 1F / 254107060142)
👩‍💻 Tiara Febrianie (D-IV TI 2I / 244107020097)

Dalam kategori Web Development, mereka menampilkan karya inovatif yang menggabungkan desain interaktif, efisiensi sistem, serta solusi digital yang relevan dengan kebutuhan masyarakat modern. Dengan bimbingan penuh dari Bapak Farid Angga Pribadi, S.Kom., M.Kom., tim Delta Dev mampu menunjukkan perpaduan sempurna antara kreativitas, kemampuan teknis, dan kerja sama tim yang solid. 

Prestasi ini menjadi bukti bahwa mahasiswa vokasi mampu bersaing dan berinovasi di dunia teknologi, menghadirkan karya nyata yang memberikan manfaat luas bagi masyarakat. 

Selamat atas pencapaian luar biasa ini! Semoga kemenangan ini menjadi inspirasi bagi seluruh mahasiswa untuk terus berkarya, berinovasi, dan berprestasi tanpa batas. ', '2021-08-10', 'berita_1766049542_Screenshot 2025-12-18 161744.png', NULL, NULL);


--
-- TOC entry 3556 (class 0 OID 18050)
-- Dependencies: 214
-- Data for Name: dosen; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.dosen VALUES (3, 'Dian Hanifudin Subhi, S.Kom., M.Kom.', ' ', '198806102019031018', '0010068807', 'subhi11@mhs.if.its.ac.id', 'Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Teknik Informatika', 'Tenaga Pengajar', '1764262773_Bapak Dian Hanifudin Subh.jpg');
INSERT INTO public.dosen VALUES (6, 'Elok Nur Hamdana, S.T., M.T', ' ', '198610022019032011', '0702108601', 'elokhamdana@gmail.com', 'Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Teknologi Informasi (Kampus Kab Lumajang)', 'Tenaga Pengajar', '1764262816_Ibu elok nur hamdana.jpg');
INSERT INTO public.dosen VALUES (1, 'Imam Fahrur Rozi, ST., MT.', ' ', '198406102008121004', '0010068402', 'imam.rozi@gmail.com', 'Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Teknik Informatika', 'Tenaga Pengajar', '1764262866_1763703891_bapakImam.jpg');
INSERT INTO public.dosen VALUES (4, 'Moch. Zawaruddin Abdullah, S.ST., M.Kom', ' ', '198902102019031019', '0010028906', 'zawaruddin@polinema.ac.id', 'Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Sistem Informasi Bisnis', 'Tenaga Pengajar', '1764262905_Bapak Moch. Zawaruddin Abdullah.jpg');
INSERT INTO public.dosen VALUES (2, 'Ridwan Rismanto, SST., M.Kom.', ' ', '198603182012121001', '0018038602', 'rismanto@polinema.ac.id', 'Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Teknik Informatika', 'Tenaga Pengajar', '1764262926_Bapak Ridwan Rismanto.jpg');
INSERT INTO public.dosen VALUES (5, 'Ariadi Retno Ririd, S.Kom., M.Kom.', ' ', '198108102005012002', '0010088101', 'faniri4education@gmail.com', 'Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', 'Sistem Informasi Bisnis', 'Tenaga Pengajar', '1764262024_Ibu Ariadi Retno Tri.jpg');


--
-- TOC entry 3579 (class 0 OID 18181)
-- Dependencies: 237
-- Data for Name: fasilitasperalatan; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.fasilitasperalatan VALUES (1, 'Studio Pengembangan', 'Workspace untuk pengembangan perangkat lunak dengan IDE, OS, dan software pendukung.');
INSERT INTO public.fasilitasperalatan VALUES (2, 'Ruang Pengujian & QA', 'Tempat untuk testing sofware, dengan alat bantu analisis dan debugging.');
INSERT INTO public.fasilitasperalatan VALUES (3, 'DevOps & Version Control', 'Peralatan CI/CD, repository, serta sistem kolaborasi dan pengembangan tim.');
INSERT INTO public.fasilitasperalatan VALUES (4, 'Fasilitas Penunjang', 'Server, jaringan, berkecepatan tinggi, ruang diskusi, dan alat kolaboratif.');


--
-- TOC entry 3577 (class 0 OID 18172)
-- Dependencies: 235
-- Data for Name: fokusriset; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.fokusriset VALUES (1, 'Software Engineering Methodologies and Architecture');
INSERT INTO public.fokusriset VALUES (2, 'Domain-Specific Software Engineering Applications');
INSERT INTO public.fokusriset VALUES (3, 'Emerging Technologies in Software Engineering');


--
-- TOC entry 3558 (class 0 OID 18056)
-- Dependencies: 216
-- Data for Name: jenis_layanan; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.jenis_layanan VALUES (1, 'Pelatihan & Workshop');
INSERT INTO public.jenis_layanan VALUES (2, 'Pendampingan Tugas Akhir');
INSERT INTO public.jenis_layanan VALUES (3, 'Pengujian Perangkat Lunak');
INSERT INTO public.jenis_layanan VALUES (4, 'Peminjaman Ruangan');


--
-- TOC entry 3581 (class 0 OID 18191)
-- Dependencies: 239
-- Data for Name: kegiatanproyek; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.kegiatanproyek VALUES (1, 'Pengembangan Kompetensi Mahasiswa', 'Mendukung mahasiswa dalam kegiatan proyek, skripsi, penelitian, atau kompetensi teknologi.');
INSERT INTO public.kegiatanproyek VALUES (2, 'Penelitian Fundamental', 'Fokus pada metodologi, manajemen proyek perangkat lunak, dan arsitektur sistem.');
INSERT INTO public.kegiatanproyek VALUES (3, 'Kolaborasi Multi-Disiplin', 'Kolaborasi lintas bidang untuk menciptakan solusi inovatif berbasis teknologi.');
INSERT INTO public.kegiatanproyek VALUES (4, 'Pengabdian Masyarakat', 'Implementasi hasil penelitian untuk menyelesaikan masalah nyata di masyarakat.');


--
-- TOC entry 3560 (class 0 OID 18060)
-- Dependencies: 218
-- Data for Name: layanan; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.layanan VALUES (11, 'ailsa', '081624271158', 'ailsagarizah@gmail.com', 'Workhop', 1, '2025-12-25', '1764907509_Surat Undangan Ketua Kelas Tingkat 1, 2, dan 3 Jurusan Teknologi Informasi.pdf', '2025-12-05 11:05:09.619815', 'approved', '15:09');
INSERT INTO public.layanan VALUES (10, 'ailsa', '089733956134', 'ailsagarizah@gmail.com', 'Demo Tugas Akhir', 2, '2025-12-31', '1764896587_1764255009_cv_JOBSHEET JAVA GUI- awal.docx', '2025-12-05 08:03:07.567991', 'ditolak', NULL);
INSERT INTO public.layanan VALUES (12, 'caca', '0986472829635', 'caca@gmail.com', 'Demo Tugas Akhir', 1, '2025-12-26', '1765796854_jadwal PBL Ganjil kelas 2 SIB .pdf', '2025-12-15 18:07:34.555593', 'approved', '20:09');
INSERT INTO public.layanan VALUES (13, 'aiska', '086242782929', 'aiska@gmail.com', 'Demo Tugas Akhir', 2, '2025-12-25', '1765797381_jadwal PBL Ganjil kelas 2 SIB .pdf', '2025-12-15 18:16:21.919583', 'approved', '23:20');
INSERT INTO public.layanan VALUES (14, 'naren', '0865326789', 'naren@gmail.com', 'Demo Tugas Akhir', 2, '2026-01-01', '1765799352_jadwal PBL Ganjil kelas 2 SIB .pdf', '2025-12-15 18:49:12.775181', 'ditolak', '20:50');
INSERT INTO public.layanan VALUES (16, 'rafi', '0876589643', 'rafi@gmail.com', 'peminjaman ruangan', 2, '2026-01-01', '1766110685_Week 17 - UAS - PYS.pdf', '2025-12-19 09:18:05.743201', 'pending', '09:20');
INSERT INTO public.layanan VALUES (17, 'naura', '0235698741', 'naura@gmail.com', 'peminjaman ruangan', 3, '2025-12-25', '1766111671_Week 17 - UAS - PYS.pdf', '2025-12-19 09:34:31.832539', 'pending', '10:33');


--
-- TOC entry 3562 (class 0 OID 18067)
-- Dependencies: 220
-- Data for Name: link_sosial; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3564 (class 0 OID 18073)
-- Dependencies: 222
-- Data for Name: mata_kuliah; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.mata_kuliah VALUES (1, 1, 'Ganjil', 'Praktikum Dasar Pemrograman');
INSERT INTO public.mata_kuliah VALUES (2, 1, 'Ganjil', 'Perancangan Produk Kreatif');
INSERT INTO public.mata_kuliah VALUES (3, 1, 'Ganjil', 'Kepemimpinan Bidang IT');
INSERT INTO public.mata_kuliah VALUES (4, 1, 'Ganjil', 'Dasar Pemrograman');
INSERT INTO public.mata_kuliah VALUES (5, 1, 'Genap', 'Proyek Teknologi Terintegrasi');
INSERT INTO public.mata_kuliah VALUES (6, 1, 'Genap', 'Praktikum Algoritma dan Struktur Data');
INSERT INTO public.mata_kuliah VALUES (7, 1, 'Genap', 'Pemrograman Berbasis Framework');
INSERT INTO public.mata_kuliah VALUES (8, 1, 'Genap', 'Algoritma dan Struktur Data');
INSERT INTO public.mata_kuliah VALUES (9, 2, 'Ganjil', 'Proyek 2');
INSERT INTO public.mata_kuliah VALUES (10, 2, 'Ganjil', 'Praktikum Pemrograman Berbasis Objek');
INSERT INTO public.mata_kuliah VALUES (11, 2, 'Ganjil', 'Pemrograman Berbasis Objek');
INSERT INTO public.mata_kuliah VALUES (12, 2, 'Genap', 'Pengembangan Perangkat Lunak Berbasis Objek');
INSERT INTO public.mata_kuliah VALUES (13, 2, 'Genap', 'Analisis dan Desain Berorientasi Objek');
INSERT INTO public.mata_kuliah VALUES (14, 3, 'Ganjil', 'Penjaminan Mutu Perangkat Lunak');
INSERT INTO public.mata_kuliah VALUES (15, 3, 'Ganjil', 'Pemrograman Mobile');
INSERT INTO public.mata_kuliah VALUES (16, 3, 'Genap', 'Sistem Operasi');
INSERT INTO public.mata_kuliah VALUES (17, 3, 'Genap', 'Proyek teknologi Terintegrasi');
INSERT INTO public.mata_kuliah VALUES (18, 3, 'Genap', 'Penjaminan Mutu Perangkat Lunak');
INSERT INTO public.mata_kuliah VALUES (19, 3, 'Genap', 'Pemrograman Jaringan');
INSERT INTO public.mata_kuliah VALUES (20, 4, 'Ganjil', 'Workshop');
INSERT INTO public.mata_kuliah VALUES (21, 4, 'Ganjil', 'Pemrograman Web Lanjut');
INSERT INTO public.mata_kuliah VALUES (22, 4, 'Ganjil', 'Pemrograman Web');
INSERT INTO public.mata_kuliah VALUES (23, 4, 'Genap', 'Proyek Sistem Informasi');
INSERT INTO public.mata_kuliah VALUES (24, 4, 'Genap', 'Praktikum Basis Data');
INSERT INTO public.mata_kuliah VALUES (25, 4, 'Genap', 'Pemrograman Web Lanjut');
INSERT INTO public.mata_kuliah VALUES (26, 4, 'Genap', 'Basis Data');
INSERT INTO public.mata_kuliah VALUES (27, 5, 'Ganjil', 'Rekayasa Perangkat Lunak');
INSERT INTO public.mata_kuliah VALUES (28, 5, 'Ganjil', 'Konsep Teknologi Informasi');
INSERT INTO public.mata_kuliah VALUES (29, 5, 'Ganjil', 'Keselamatan dan Kesehatan Kerja');
INSERT INTO public.mata_kuliah VALUES (30, 5, 'Genap', 'Sistem Operasi');
INSERT INTO public.mata_kuliah VALUES (31, 5, 'Genap', 'Kecerdasan Artificial');
INSERT INTO public.mata_kuliah VALUES (32, 6, 'Ganjil', 'Praktikum Basis Data Lanjut');
INSERT INTO public.mata_kuliah VALUES (33, 6, 'Ganjil', 'Konsep Teknologi Informasi');
INSERT INTO public.mata_kuliah VALUES (34, 6, 'Ganjil', 'Desain dan Pemrograman Web');
INSERT INTO public.mata_kuliah VALUES (35, 6, 'Ganjil', 'Basis Data Lanjut');
INSERT INTO public.mata_kuliah VALUES (36, 6, 'Genap', 'Praktikum Basis Data');
INSERT INTO public.mata_kuliah VALUES (37, 6, 'Genap', 'Pengenalan Sistem Informasi');
INSERT INTO public.mata_kuliah VALUES (38, 6, 'Genap', 'Basis Data');


--
-- TOC entry 3593 (class 0 OID 18564)
-- Dependencies: 254
-- Data for Name: media_gambar; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.media_gambar VALUES (1, 'berita', 1, 'berita1.png', '2025-12-08 08:24:52.258581');
INSERT INTO public.media_gambar VALUES (2, 'berita', 2, 'berita2.png', '2025-12-08 08:24:52.258581');
INSERT INTO public.media_gambar VALUES (3, 'berita', 3, 'berita3.png', '2025-12-08 08:24:52.258581');
INSERT INTO public.media_gambar VALUES (4, 'berita', 4, 'berita4.png', '2025-12-08 08:24:52.258581');
INSERT INTO public.media_gambar VALUES (5, 'berita', 5, 'berita5.png', '2025-12-08 08:24:52.258581');
INSERT INTO public.media_gambar VALUES (6, 'berita', 8, 'berita6.png', '2025-12-08 08:24:52.258581');


--
-- TOC entry 3566 (class 0 OID 18078)
-- Dependencies: 224
-- Data for Name: open_recruitment; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.open_recruitment VALUES (8, 'ailsa', 'ailsagarizah@gmail.com', '089733956134', '1764907784_cv_1764255009_cv_JOBSHEET JAVA GUI- awal (2).docx', '1764907784_ktm_Surat Undangan Ketua Kelas Tingkat 1, 2, dan 3 Jurusan Teknologi Informasi.pdf', '2025-12-05 11:09:44.056551', 'approved', '244107060006');
INSERT INTO public.open_recruitment VALUES (9, 'ailsa', 'ailsashda13@gmail.com', '089733956134', '1765446878_cv_JOBSHEET JAVA GUI- ENGLISH.pdf', '1765446878_ktm_JOBSHEET JAVA GUI- ENGLISH.pdf', '2025-12-11 16:54:38.891102', 'ditolak', '244107060006');
INSERT INTO public.open_recruitment VALUES (11, 'ganang', 'ganang@gmail.com', '09753271811917', '1765800016_cv_jadwal PBL Ganjil kelas 2 SIB .pdf', '1765800016_ktm_jadwal PBL Ganjil kelas 2 SIB .pdf', '2025-12-15 19:00:16.872676', 'approved', '244107060006');
INSERT INTO public.open_recruitment VALUES (12, 'ganang', 'ganang@gmail.com', '089733956134', '1765876871_cv_#wallpaper.jpg', '1765876871_ktm_#wallpaper.jpg', '2025-12-16 16:21:11.18487', 'ditolak', '244107060006');
INSERT INTO public.open_recruitment VALUES (10, 'naren', 'ganang@gmail.com', '098642791', '1765796905_cv_Screenshot 2025-12-15 165129.png', '1765796905_ktm_Screenshot 2025-12-15 165719.png', '2025-12-15 18:08:25.155385', 'approved', '244107060006');


--
-- TOC entry 3568 (class 0 OID 18085)
-- Dependencies: 226
-- Data for Name: pendidikan; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.pendidikan VALUES (1, 1, 'S2', 'Teknik Elektro', 'Universitas Brawijaya', '2010-2012');
INSERT INTO public.pendidikan VALUES (2, 1, 'S1', 'Teknik Elektro', 'Universitas Brawijaya', '2002-2007');
INSERT INTO public.pendidikan VALUES (3, 2, 'S1', 'Teknik Informatika', 'Institut Teknologi Sepuluh Nopember', '2009 - 2011');
INSERT INTO public.pendidikan VALUES (4, 2, 'S2', 'Computer Science', 'Kumamoto University', '2011');
INSERT INTO public.pendidikan VALUES (5, 2, 'S3', 'Teknologi Informasi', 'Hiroshima university', '2020 - 2025');
INSERT INTO public.pendidikan VALUES (6, 3, 'S1', 'Teknik Informatika', 'Institut Teknologi Sepuluh Nopember', '2011 - 2015');
INSERT INTO public.pendidikan VALUES (7, 3, 'S2', 'Teknik Informatika', 'Institut Teknologi Sepuluh Nopember', '2006 - 2010');
INSERT INTO public.pendidikan VALUES (8, 4, 'D3', 'Teknik Informatika', 'Politeknik Negeri Bandung', '2007 - 2010');
INSERT INTO public.pendidikan VALUES (9, 4, 'D4', 'Teknik Informatika', 'Politeknik Elektronika Negeri Surabaya', '2011 - 2013');
INSERT INTO public.pendidikan VALUES (10, 4, 'S2', 'Teknik Informatika', 'Institut Teknologi Sepuluh Nopember', '2016 - 2018');
INSERT INTO public.pendidikan VALUES (11, 5, 'S1', 'Magister Komputer', 'Institut Teknologi Sepuluh Nopember', '2010');
INSERT INTO public.pendidikan VALUES (12, 5, 'S2', 'Sarjana Komputer', 'Institut Teknologi Sepuluh Nopember', '2004');
INSERT INTO public.pendidikan VALUES (13, 6, 'S2', 'Magister Teknik', 'Universitas Brawijaya', '2012');


--
-- TOC entry 3591 (class 0 OID 18546)
-- Dependencies: 251
-- Data for Name: pengumuman; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.pengumuman VALUES (1, 'Pengumuman Persyaratan Bantuan UKT / SPP Tahun 2025', 'Bagi kalian, mahasiswa aktif semester ganjil tahun 2025 / 2026 yang sedang membutuhkan keringanan pembayaran UKT, Politeknik Negeri Malang memberikan  program bantuan UKT / SPP Tahun 2025.', '2025-11-10', 'img/pengumuman1.png', 'img/pengumuman2.png', 'img/pengumuman3.png');
INSERT INTO public.pengumuman VALUES (2, 'Batas Pendaftaran dan Pelaksanaan Ujian Skripsi Tahap III Tahun Ajaran 2024/2025', 'Ujian skripsi tahap III tahun Ajaran 2024/2025:
Batas Pendaftaran 18 Juli 2025
Pelaksanaan Ujian 21-25 Juli 2025

Info lebih lanjut silahkan akses: Sistem Informasi Tugas Akhir', '2024-12-20', 'pengumuman1.png', NULL, NULL);


--
-- TOC entry 3583 (class 0 OID 18200)
-- Dependencies: 241
-- Data for Name: perkuliahanterkait; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.perkuliahanterkait VALUES (1, 'Analisis & Perancangan Sistem Informasi', 'Proses sistematis yang membahas pemenuhan kebutuhan bisnis dan perancangan solusi informasi.');
INSERT INTO public.perkuliahanterkait VALUES (2, 'Analisis dan Desain Berorientasi Objek (ADBO)', 'Metodologi pengembangan perangkat lunak dengan objek sebagai dasar untuk analisis kebutuhan sistem.');
INSERT INTO public.perkuliahanterkait VALUES (3, 'Desain & Pemrograman Web', 'Pemahaman prinsip perancangan antarmuka dan fungsionalitas dasar berbasis web.');
INSERT INTO public.perkuliahanterkait VALUES (4, 'Pemrograman Backend', 'Fokus pada pengelolaan server, database, dan API sebagai bagian dari aplikasi web dinamis.');
INSERT INTO public.perkuliahanterkait VALUES (5, 'Pemrograman Berbasis Framework', 'Membahas framework kerja untuk pengembangan web efisien dan terstruktur.');
INSERT INTO public.perkuliahanterkait VALUES (6, 'Pemrograman Web', 'Pemahaman dasar-dasar pembuatan struktur web dengan HTML, CSS, dan JavaScript.');
INSERT INTO public.perkuliahanterkait VALUES (7, 'Pemrograman Web Lanjut', 'Lanjutan dari Pemrograman Web, fokus pada teknologi web modern seperti React dan Vue.');
INSERT INTO public.perkuliahanterkait VALUES (8, 'Penjaminan Mutu Perangkat Lunak', 'Membahas teknik uji perangkat lunak untuk memastikan kualitas produk sebelum rilis.');
INSERT INTO public.perkuliahanterkait VALUES (9, 'Rekayasa Perangkat Lunak', 'Pengantar tentang struktur dan manajemen proyek perangkat lunak skala besar.');


--
-- TOC entry 3575 (class 0 OID 18163)
-- Dependencies: 233
-- Data for Name: profilelab; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.profilelab VALUES (1, 'PROFILE LABORATORIUM', 'Laboratorium Rekayasa Perangkat Lunak merupakan fasilitas akademik di bawah naungan Jurusan Teknologi Informasi yang berfokus pada bidang rekayasa pengembangan perangkat lunak. Laboratorium ini diharapkan tumbuh menjadi pusat aktivitas penelitian dan pengabdian masyarakat yang berorientasi pada pengembangan teknologi perangkat lunak. tes');


--
-- TOC entry 3570 (class 0 OID 18089)
-- Dependencies: 228
-- Data for Name: publikasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.publikasi VALUES (1, 1, 'Sinta', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6005739');
INSERT INTO public.publikasi VALUES (2, 1, 'Google Scholar', 'https://scholar.google.com/citations?user=WwrDWnEAAAAJ&hl=en');
INSERT INTO public.publikasi VALUES (3, 2, 'Google Scholar', 'https://scholar.google.com/citations?hl=en&user=fJc_GegAAAAJ');
INSERT INTO public.publikasi VALUES (4, 2, 'Sinta', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6018829');
INSERT INTO public.publikasi VALUES (5, 5, 'Google Scholar', 'https://scholar.google.com/citations?view_op=list_works&hl=id&hl=id&user=qoWiXaQAAAAJ');
INSERT INTO public.publikasi VALUES (6, 5, 'Sinta', 'https://scholar.google.com/citations?view_op=list_works&hl=id&hl=id&user=qoWiXaQAAAAJ');
INSERT INTO public.publikasi VALUES (7, 3, 'Google Scholar', 'https://scholar.google.com/citations?user=pR2Dn7MAAAAJ&hl=en');
INSERT INTO public.publikasi VALUES (8, 3, 'Sinta', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6736320');
INSERT INTO public.publikasi VALUES (9, 6, 'Google Scholar', 'https://scholar.google.com/citations?user=cduv_fAAAAAJ&hl=en');
INSERT INTO public.publikasi VALUES (10, 6, 'Sinta', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6754038');
INSERT INTO public.publikasi VALUES (11, 4, 'Google Scholar', 'https://scholar.google.com/citations?user=0uPC_KcAAAAJ&hl=id');
INSERT INTO public.publikasi VALUES (12, 4, 'Sinta', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6714037');


--
-- TOC entry 3605 (class 0 OID 18633)
-- Dependencies: 267
-- Data for Name: roadmap; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.roadmap VALUES (1, 2023, 'Inisiasi LAB Software Engineering', 'Inisiasi pembentukan LAB Software Engineering dan penyusunan struktur organisasi awal');
INSERT INTO public.roadmap VALUES (2, 2024, 'Pengembangan Internal', 'Mulai kegiatan studi internal dan pembuatan website resmi LAB Software Engineering');
INSERT INTO public.roadmap VALUES (3, 2025, 'Kolaborasi Eksternal', 'Peluncuran sistem informasi internal serta kolaborasi pertama dengan pihak industri');
INSERT INTO public.roadmap VALUES (4, 2026, 'Modernisasi Infrastruktur', 'Implementasi CI/CD, modernisasi website, dan penguatan kegiatan DevOps untuk anggota');
INSERT INTO public.roadmap VALUES (5, 2027, 'Ekspansi dan Kolaborasi', 'Fokus pada riset AI, kolaborasi startup teknologi, dan ekspansi skala proyek nasional');


--
-- TOC entry 3601 (class 0 OID 18605)
-- Dependencies: 263
-- Data for Name: sarana_prasarana; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.sarana_prasarana VALUES (1, 'Ruang Baca Lt 6', 'Ruang baca dengan koleksi buku lengkap.', 'ruang_baca_6.jpg');
INSERT INTO public.sarana_prasarana VALUES (2, 'Ruang Baca 1 Lt 6', 'Fasilitas ruang baca tambahan.', 'ruang_baca1_6.jpg');


--
-- TOC entry 3595 (class 0 OID 18578)
-- Dependencies: 257
-- Data for Name: sejarah; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.sejarah VALUES (1, 'Sejarah Jurusan Teknologi Informasi', 'Jurusan Teknologi Informasi Politeknik Negeri Malang berawal dari pendirian Program Studi(Prodi) Diploma 3 (D3) Manajemen Informatika (MI) pada tanggal 24 juni 2005 berdasarkan SK nomer pendirian program studi 2001/D/T/2005. Pada surat keputusan tersebut Politeknik Negeri Malang diberikan ijin oleh Direktorat Jenderal Pendidikan Tinggi (Dikti) untuk menyelenggarakan pendidikan Program Studi Manajemen Informatika untuk jenjang program D3 dibawah Jurusan Teknik Elektro. Pada awal berdiri Prodi D3 MI memiliki 92 Mahasiswa, 1 Teknisi, 1 Administrasi, 6 Dosen tetap dan beberapa Dosen luar biasa. Pada tahun-tahun selanjutnya Prodi D3 MI berkembang sangat cepat hal ini ditandai dengan berkembangnya jumlah dari 92 di tahun 2005 menjadi 502 di tahun 2019. Peningkatan jumlah mahasiswa tersebut didukung dengan bertambahnya jumlah dosen, teknisi, tenaga kependidikan maupun sarana dan prasarana. Hal ini menunjukkan bahwa kepercayaan masyarakat terhadap Prodi D3 MI semakin meningkat. Pada sisi yang lain ternyata kebutuhan masyarakat dan industri terhadap lulusan Politeknik
tidak cukup hanya dengan jenjang D3 tetapi juga pada jenjang sarjana yang selanjutnya dikenal dengan sebutan sarjana terapan atau Diploma 4 (D4).


Pada tahun 2010 berdasar atas kebutuhan masyarakat dan indust terkait Program Diploma IV bidang Teknik informatika maka Polinema mendirikan program studi baru Teknik Informatika (TI) dengan jenjang Sarjana Terapan atau Diploma IV. Pada awal berdirinya di tahun 2010 jumlah peserta didik Program D-IV TI hanya terdiri dari 49 Mahasiwa, namun pada tahun 2015 jumlah peserta didik Prodi D-IV TI telah mengalami peningkatan menjadi 553 Mahasiswa. Perkembangan yang sangat pesat baik di Program Studi D-III MI dan D-IV TI mendorong pimpinan di Polinema untuk mengembangkan kedua program studi tersebut dibawa Jurusan baru terpisah dari Jurusan Teknik Elektro.


Pada tahun 2015 berdasarkan SK Direktur Nomor 53 dalam rangka peningkatan mutu pengelolaan dan optimasi sumber daya dibentuklah Jurusan Teknologi Informasi (JTI) yang menaungi. Prodi D3 MI dan D4 TI. Setelah menjadi Jurusan tersendiri kemajuan kedua Prodi tersebut sesuai dengan harapan hal ini terlihat pada saat buku Renstra JTI ini direvisi Jumlah mahasiswa di JTI telah mencapai 1289 mahasiswa yang terdiri dari 409 mahasiswa Prodi D3 MI dan 880 Mahasiswa Prodi D4 TI. Mulai tahun 2019 bertambah 3 program studi D3 diluar kampus utama (PSDKU) yaitu D3 Manajemen Informatika Kediri, D3 Manajemen Informatika Pamekasan, dan D3 Teknologi Informasi Lumajang.


Pada tahun 2020 melihat kebutuhan Industri dan instruksi dari Kementrian Pendidikan Kebudayaan, Riset dan Teknologi, Program Studi D3 Manajemen Informatika yang berada di kampus utama di ubah menjadi D4 Sistem Informasi Bisnis dan menambah 2 prodi baru yaitu D2 Pengembangan Piranti Lunak Situs (program jalur cepat) dan S2 Magister Terapan Rekayasa Teknologi Informasi.');


--
-- TOC entry 3599 (class 0 OID 18596)
-- Dependencies: 261
-- Data for Name: struktur_organisasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.struktur_organisasi VALUES (1, 'Ketua Jurusan', 'Prof. Dr. Eng. Rosa Andrie Asmara, ST., MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (2, 'Sekretaris Jurusan', 'Mungki Astiningrum, ST., M.Kom.', NULL);
INSERT INTO public.struktur_organisasi VALUES (3, 'Koordinator Program Studi S2 Magister Terapan Rekayasa Teknologi Informasi', 'Dr. Eng. Banni Satria Andoko, S. Kom., M.MSI.', NULL);
INSERT INTO public.struktur_organisasi VALUES (4, 'Koordinator Program Studi D4 Teknik Informatika', 'Dr. Ely Setyo Astuti, ST., MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (5, 'Koordinator Program Studi D4 Sistem Informasi Bisnis', 'Hendra Pradibta, SE., M.Sc.', NULL);
INSERT INTO public.struktur_organisasi VALUES (6, 'Koordinator Program Studi D2 Pengembangan Piranti Lunak Situs', 'Pramana Yoga Saputra, S.Kom., MMT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (7, 'Kepala Laboratorium Jaringan dan Keamanan Siber', 'Erfan Rohadi, ST., M.Eng., Ph.D.', NULL);
INSERT INTO public.struktur_organisasi VALUES (8, 'Kepala Laboratorium Rekayasa Perangkat Lunak', 'Imam Fahrur Rozi, ST., MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (9, 'Kepala Laboratorium Visi Cerdas dan Sistem Cerdas', 'Prof. Dr. Eng. Rosa Andrie Asmara, ST., MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (10, 'Kepala Laboratorium Sistem Informasi', 'Dr. Eng. Banni Satria Andoko, S. Kom., M.MSI.', NULL);
INSERT INTO public.struktur_organisasi VALUES (11, 'Kepala Laboratorium Analisa Bisnis', 'Dr. Rakhmat Arianto, S.ST., M.Kom.', NULL);
INSERT INTO public.struktur_organisasi VALUES (12, 'Kepala Laboratorium Teknologi Data', 'Yoppy Yunhasnawa, S.ST., M.Sc.', NULL);
INSERT INTO public.struktur_organisasi VALUES (13, 'Kepala Laboratorium Multimedia dan Perangkat Bergerak', 'Dimas Wahyu Wibowo, ST., MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (14, 'Kepala Laboratorium Informatika Terapan', 'Ir. Yan Watequlis Syaifuddin, ST., M.MT., Ph. D.', NULL);
INSERT INTO public.struktur_organisasi VALUES (15, 'Dosen Pembimbing Kemahasiswaan', 'Bagas Satya Dian Nugraha, ST., MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (16, 'Ketua Majelis Skripsi dan Tugas Akhir', 'Yoppy Yunhasnawa, S.ST., M.Sc.', NULL);
INSERT INTO public.struktur_organisasi VALUES (17, 'Koordinator Kurikulum S2 Magister Terapan Rekayasa Teknologi Informasi', 'Dr. Indra Dharma Wijaya, ST., M.MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (18, 'Koordinator Kurikulum D4 Teknik Informatika', 'Imam Fahrur Rozi, ST., MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (19, 'Koordinator Bidang Keahlian Rekayasa Perangkat Lunak D4 Teknik Informatika', 'Wilda Imama Sabilla, S.Kom., M.Kom', NULL);
INSERT INTO public.struktur_organisasi VALUES (20, 'Koordinator Bidang Keahlian Visi Cerdas dan Sistem Cerdas D4 Teknik Informatika', 'Mamluatul Hani’ah, S.Kom., M.Kom', NULL);
INSERT INTO public.struktur_organisasi VALUES (21, 'Koordinator Bidang Keahlian Multimedia dan Perangkat Bergerak D4 Teknik Informatika', 'M. Hasyim Ratsanjani, S.Kom., M.Kom', NULL);
INSERT INTO public.struktur_organisasi VALUES (22, 'Koordinator Bidang Keahlian Jaringan dan Keamanan Siber D4 Teknik Informatika', 'Habibie Ed Dien, S.Kom., M.T.', NULL);
INSERT INTO public.struktur_organisasi VALUES (23, 'Koordinator Prakerin & Kerjasama D4 Teknik Informatika', 'Dika Rizky Yunianto, S.Kom, M.Kom', NULL);
INSERT INTO public.struktur_organisasi VALUES (24, 'Koordinator Kurikulum D4 Sistem Informasi Bisnis', 'Meyti Eka Apriyani ST., MT.', NULL);
INSERT INTO public.struktur_organisasi VALUES (25, 'Koordinator Bidang Keahlian Sistem Informasi D4 Sistem Informasi Bisnis', 'Rokhimatul Wakhidah, S.Pd., M.T.', NULL);
INSERT INTO public.struktur_organisasi VALUES (26, 'Koordinator Bidang Keahlian Analisa Bisnis D4 Sistem Informasi Bisnis', 'Ir. Rudy Ariyanto, ST., M.Cs.', NULL);
INSERT INTO public.struktur_organisasi VALUES (27, 'Koordinator Bidang Keahlian Teknologi Data D4 Sistem Informasi Bisnis', 'Agung Nugroho Pramudhita, S.T., M.T.', NULL);
INSERT INTO public.struktur_organisasi VALUES (28, 'Koordinator Bidang Keahlian Informatika Terapan D4 Sistem Informasi Bisnis', 'Triana Fatmawati, S.T., M.T.', NULL);
INSERT INTO public.struktur_organisasi VALUES (29, 'Koordinator Prakerin & Kerjasama D4 Sistem Informasi Bisnis', 'Vivin Ayu Lestari, S.Pd., M.Kom.', NULL);
INSERT INTO public.struktur_organisasi VALUES (30, 'Koordinator Kurikulum D2 Pengembangan Piranti Lunak Situs', 'Endah Septa Sintiya, S.Pd., M.Kom', NULL);
INSERT INTO public.struktur_organisasi VALUES (31, 'Koordinator Prakerin & Kerjasama D2 Pengembangan Piranti Lunak Situs', 'Dika Rizky Yunianto, S.Kom, M.Kom', NULL);


--
-- TOC entry 3607 (class 0 OID 18642)
-- Dependencies: 269
-- Data for Name: tenaga_kependidikan; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tenaga_kependidikan VALUES (1, 'Ana Agustina, S.M.', NULL, 'Akademik D4 Teknik Informatika');
INSERT INTO public.tenaga_kependidikan VALUES (2, 'Anggi Putra Woon, A.Md.', NULL, 'Teknisi Jurusan');
INSERT INTO public.tenaga_kependidikan VALUES (3, 'Aprilia Dwi Saputri, A.Md', NULL, 'Pranata Laboratorium Pendidikan');
INSERT INTO public.tenaga_kependidikan VALUES (4, 'Danin, S.AP.', NULL, 'Administrasi Jurusan');
INSERT INTO public.tenaga_kependidikan VALUES (5, 'Dwi Atmo Nugroho, ST', NULL, 'Administrasi Barang Milik Negara');
INSERT INTO public.tenaga_kependidikan VALUES (6, 'Eti Mukharomah, A.Md.Kom', NULL, 'Pranata Laboratorium Pendidikan');
INSERT INTO public.tenaga_kependidikan VALUES (7, 'Helmi Setya, A.Md.Kom.', NULL, 'Pranata Laboratorium Pendidikan');
INSERT INTO public.tenaga_kependidikan VALUES (8, 'Lailatul Qodriyah, S.Sos.', NULL, 'Tenaga Kependidikan – Administrasi D4 Sistem Informasi Bisnis dan D2 Pengembangan Piranti Lunak Situs');
INSERT INTO public.tenaga_kependidikan VALUES (9, 'Mariska Dwitya Adilasari, A.Md.', NULL, 'Administrasi Kepegawaian Jurusan');
INSERT INTO public.tenaga_kependidikan VALUES (10, 'Mulyo Prasetyo, SE.', NULL, 'Administrasi Barang Milik Negara');
INSERT INTO public.tenaga_kependidikan VALUES (11, 'Rizka Dianfitri Paramita, S.I.Kom, M.M.', NULL, 'Akademik D4 Sistem Informasi Bisnis dan D2 Pengembangan Piranti Lunak Situs');
INSERT INTO public.tenaga_kependidikan VALUES (12, 'Roszyhana Hadi Untari, S.Pd.', NULL, 'Tenaga Kependidikan – Administrasi Keuangan Jurusan');
INSERT INTO public.tenaga_kependidikan VALUES (13, 'Sujadi', NULL, 'Teknisi Jurusan');
INSERT INTO public.tenaga_kependidikan VALUES (14, 'Sri Whariyanti, S.S.', NULL, 'Tenaga Kependidikan – Administrasi D4 Teknik Informatika');
INSERT INTO public.tenaga_kependidikan VALUES (15, 'Titis Octary Satrio, S.ST., M.MT.', NULL, 'Administrasi Akademik D2 Pengembangan Piranti Lunak Situs dan D4 Sistem Informasi Bisnis');
INSERT INTO public.tenaga_kependidikan VALUES (16, 'Widya Novy Nuraeny, A.Md.', NULL, 'Tenaga Kependidikan – Administrasi Barang Milik Negara');


--
-- TOC entry 3603 (class 0 OID 18615)
-- Dependencies: 265
-- Data for Name: tenaga_pengajar; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tenaga_pengajar VALUES (1, 'Hendra Pradibta, SE., M.Sc.', '0021058301', 'Tenaga Pengajar', 'WhatsApp Image 2025-12-17 at 16.17.19.jpeg');


--
-- TOC entry 3585 (class 0 OID 18445)
-- Dependencies: 243
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.users VALUES (1, 'Admin Laboratorium SE', 'admin', '$2y$10$h5hXYEM7fyG24ZqllXmVxO9akIVpVcgEDQiQM0aMERbdD9k5vPN8m', 'admin');
INSERT INTO public.users VALUES (2, 'Dosen Teknologi Informasi', 'dosen', '$2y$10$1r0595JfxmdmpFX0Bppyh.glUbAg3fl4qBdxn6Nu4usv8DpOBy21e', 'acc permohonan');


--
-- TOC entry 3573 (class 0 OID 18154)
-- Dependencies: 231
-- Data for Name: visi_misi; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.visi_misi VALUES (1, 'Menjadi pusat unggulan dalam pengembangan ilmu pengetahuan, teknologi, dan inovasi di bidang Rekayasa Perangkat Lunak yang berdaya saing global, dengan kontribusi nyata pada kemajuan akademik, industri, dan masyarakat.', '<ol><li>Mengembangkan kompetensi mahasiswa.</li><li>Mendorong penelitian fundamental dan terapan. </li><li>Meningkatkan kolaborasi multi-disiplin. </li><li>Mengoptimalkan pemanfaatan teknologi terkini. </li><li>Mewujudkan pengabdian masyarakat berbasis riset.&nbsp;</li></ol>');


--
-- TOC entry 3597 (class 0 OID 18587)
-- Dependencies: 259
-- Data for Name: visi_misi_tujuan; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.visi_misi_tujuan VALUES (1, 'Visi Jurusan Teknologi Informasi Polinema adalah sebagai pusat unggulan di bidang Teknologi Informasi dan rekayasa perangkat lunak di tingkat nasional maupun internasional.', '<p>Misi Jurusan Teknologi Informasi Politeknik Negeri Malang: </p><ol><li>Melaksanakan pendidikan vokasi yang inovatif berdasarkan pada sistem pendidikan terapan dengan memanfaatkan kemajuan Teknologi Informasi dan Telekomunikasi. </li><li>Menghasilkan penelitian terapan berbasis produk dan jasa bidang Informatika. </li><li>Melaksanakan pengabdian masyarakat dengan menggunakan kemajuan Teknologi Informasi. </li><li>Terwujudnya kerjasama dengan berbagai pihak di dalam dan luar negeri.</li></ol>', '<p>Tujuan Teknologi Informasi Politeknik Negeri Malang: </p><ol><li>Menghasilkan lulusan bidang Teknologi Informasi dan Rekayasa Perangkat Lunak yang beretika dan berpengetahuan tinggi.</li><li>Menghasilkan penelitian terapan tingkat internasional, serta mengarah pada pencapaian HaKI dan kesejahteraan masyarakat. </li><li>Menghasilkan pengabdian kepada masyarakat melalui penerapan ilmu pengetahuan dan teknologi. </li><li>Terwujudnya kerjasama dengan berbagai pihak baik di dalam maupun di luar negeri untuk meningkatkan daya saing.</li></ol>');


--
-- TOC entry 3639 (class 0 OID 0)
-- Dependencies: 247
-- Name: agenda_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.agenda_id_seq', 27, true);


--
-- TOC entry 3640 (class 0 OID 0)
-- Dependencies: 245
-- Name: berita_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.berita_id_seq', 21, true);


--
-- TOC entry 3641 (class 0 OID 0)
-- Dependencies: 215
-- Name: dosen_id_dosen_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dosen_id_dosen_seq', 11, true);


--
-- TOC entry 3642 (class 0 OID 0)
-- Dependencies: 236
-- Name: fasilitasperalatan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fasilitasperalatan_id_seq', 7, true);


--
-- TOC entry 3643 (class 0 OID 0)
-- Dependencies: 234
-- Name: fokusriset_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fokusriset_id_seq', 6, true);


--
-- TOC entry 3644 (class 0 OID 0)
-- Dependencies: 217
-- Name: jenis_layanan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jenis_layanan_id_seq', 4, true);


--
-- TOC entry 3645 (class 0 OID 0)
-- Dependencies: 238
-- Name: kegiatanproyek_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.kegiatanproyek_id_seq', 6, true);


--
-- TOC entry 3646 (class 0 OID 0)
-- Dependencies: 219
-- Name: layanan_id_lay_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.layanan_id_lay_seq', 17, true);


--
-- TOC entry 3647 (class 0 OID 0)
-- Dependencies: 221
-- Name: link_sosial_id_link_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.link_sosial_id_link_seq', 1, false);


--
-- TOC entry 3648 (class 0 OID 0)
-- Dependencies: 223
-- Name: mata_kuliah_id_mk_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mata_kuliah_id_mk_seq', 48, true);


--
-- TOC entry 3649 (class 0 OID 0)
-- Dependencies: 253
-- Name: media_gambar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.media_gambar_id_seq', 6, true);


--
-- TOC entry 3650 (class 0 OID 0)
-- Dependencies: 225
-- Name: open_recruitment_id_or_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.open_recruitment_id_or_seq', 12, true);


--
-- TOC entry 3651 (class 0 OID 0)
-- Dependencies: 227
-- Name: pendidikan_id_pendidikan_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pendidikan_id_pendidikan_seq', 18, true);


--
-- TOC entry 3652 (class 0 OID 0)
-- Dependencies: 250
-- Name: pengumuman_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengumuman_id_seq', 11, true);


--
-- TOC entry 3653 (class 0 OID 0)
-- Dependencies: 240
-- Name: perkuliahanterkait_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.perkuliahanterkait_id_seq', 11, true);


--
-- TOC entry 3654 (class 0 OID 0)
-- Dependencies: 232
-- Name: profilelab_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.profilelab_id_seq', 1, true);


--
-- TOC entry 3655 (class 0 OID 0)
-- Dependencies: 229
-- Name: publikasi_id_publikasi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.publikasi_id_publikasi_seq', 13, true);


--
-- TOC entry 3656 (class 0 OID 0)
-- Dependencies: 266
-- Name: roadmap_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roadmap_id_seq', 5, true);


--
-- TOC entry 3657 (class 0 OID 0)
-- Dependencies: 262
-- Name: sarana_prasarana_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sarana_prasarana_id_seq', 4, true);


--
-- TOC entry 3658 (class 0 OID 0)
-- Dependencies: 256
-- Name: sejarah_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sejarah_id_seq', 1, true);


--
-- TOC entry 3659 (class 0 OID 0)
-- Dependencies: 260
-- Name: struktur_organisasi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.struktur_organisasi_id_seq', 37, true);


--
-- TOC entry 3660 (class 0 OID 0)
-- Dependencies: 268
-- Name: tenaga_kependidikan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tenaga_kependidikan_id_seq', 18, true);


--
-- TOC entry 3661 (class 0 OID 0)
-- Dependencies: 264
-- Name: tenaga_pengajar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tenaga_pengajar_id_seq', 3, true);


--
-- TOC entry 3662 (class 0 OID 0)
-- Dependencies: 242
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- TOC entry 3663 (class 0 OID 0)
-- Dependencies: 230
-- Name: visi_misi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visi_misi_id_seq', 1, true);


--
-- TOC entry 3664 (class 0 OID 0)
-- Dependencies: 258
-- Name: visi_misi_tujuan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visi_misi_tujuan_id_seq', 1, true);


--
-- TOC entry 3386 (class 2606 OID 18540)
-- Name: agenda agenda_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agenda
    ADD CONSTRAINT agenda_pkey PRIMARY KEY (id);


--
-- TOC entry 3384 (class 2606 OID 18526)
-- Name: berita berita_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.berita
    ADD CONSTRAINT berita_pkey PRIMARY KEY (id);


--
-- TOC entry 3352 (class 2606 OID 18105)
-- Name: dosen dosen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dosen
    ADD CONSTRAINT dosen_pkey PRIMARY KEY (id_dosen);


--
-- TOC entry 3374 (class 2606 OID 18188)
-- Name: fasilitasperalatan fasilitasperalatan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fasilitasperalatan
    ADD CONSTRAINT fasilitasperalatan_pkey PRIMARY KEY (id);


--
-- TOC entry 3372 (class 2606 OID 18179)
-- Name: fokusriset fokusriset_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fokusriset
    ADD CONSTRAINT fokusriset_pkey PRIMARY KEY (id);


--
-- TOC entry 3354 (class 2606 OID 18107)
-- Name: jenis_layanan jenis_layanan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jenis_layanan
    ADD CONSTRAINT jenis_layanan_pkey PRIMARY KEY (id);


--
-- TOC entry 3376 (class 2606 OID 18198)
-- Name: kegiatanproyek kegiatanproyek_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kegiatanproyek
    ADD CONSTRAINT kegiatanproyek_pkey PRIMARY KEY (id);


--
-- TOC entry 3356 (class 2606 OID 18109)
-- Name: layanan layanan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.layanan
    ADD CONSTRAINT layanan_pkey PRIMARY KEY (id_lay);


--
-- TOC entry 3358 (class 2606 OID 18111)
-- Name: link_sosial link_sosial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.link_sosial
    ADD CONSTRAINT link_sosial_pkey PRIMARY KEY (id_link);


--
-- TOC entry 3360 (class 2606 OID 18113)
-- Name: mata_kuliah mata_kuliah_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mata_kuliah
    ADD CONSTRAINT mata_kuliah_pkey PRIMARY KEY (id_mk);


--
-- TOC entry 3390 (class 2606 OID 18572)
-- Name: media_gambar media_gambar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media_gambar
    ADD CONSTRAINT media_gambar_pkey PRIMARY KEY (id);


--
-- TOC entry 3362 (class 2606 OID 18115)
-- Name: open_recruitment open_recruitment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.open_recruitment
    ADD CONSTRAINT open_recruitment_pkey PRIMARY KEY (id_or);


--
-- TOC entry 3364 (class 2606 OID 18117)
-- Name: pendidikan pendidikan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendidikan
    ADD CONSTRAINT pendidikan_pkey PRIMARY KEY (id_pendidikan);


--
-- TOC entry 3388 (class 2606 OID 18554)
-- Name: pengumuman pengumuman_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengumuman
    ADD CONSTRAINT pengumuman_pkey PRIMARY KEY (id);


--
-- TOC entry 3378 (class 2606 OID 18207)
-- Name: perkuliahanterkait perkuliahanterkait_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perkuliahanterkait
    ADD CONSTRAINT perkuliahanterkait_pkey PRIMARY KEY (id);


--
-- TOC entry 3370 (class 2606 OID 18170)
-- Name: profilelab profilelab_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profilelab
    ADD CONSTRAINT profilelab_pkey PRIMARY KEY (id);


--
-- TOC entry 3366 (class 2606 OID 18119)
-- Name: publikasi publikasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publikasi
    ADD CONSTRAINT publikasi_pkey PRIMARY KEY (id_publikasi);


--
-- TOC entry 3402 (class 2606 OID 18640)
-- Name: roadmap roadmap_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roadmap
    ADD CONSTRAINT roadmap_pkey PRIMARY KEY (id);


--
-- TOC entry 3398 (class 2606 OID 18612)
-- Name: sarana_prasarana sarana_prasarana_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sarana_prasarana
    ADD CONSTRAINT sarana_prasarana_pkey PRIMARY KEY (id);


--
-- TOC entry 3392 (class 2606 OID 18585)
-- Name: sejarah sejarah_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sejarah
    ADD CONSTRAINT sejarah_pkey PRIMARY KEY (id);


--
-- TOC entry 3396 (class 2606 OID 18603)
-- Name: struktur_organisasi struktur_organisasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.struktur_organisasi
    ADD CONSTRAINT struktur_organisasi_pkey PRIMARY KEY (id);


--
-- TOC entry 3404 (class 2606 OID 18649)
-- Name: tenaga_kependidikan tenaga_kependidikan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tenaga_kependidikan
    ADD CONSTRAINT tenaga_kependidikan_pkey PRIMARY KEY (id);


--
-- TOC entry 3400 (class 2606 OID 18622)
-- Name: tenaga_pengajar tenaga_pengajar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tenaga_pengajar
    ADD CONSTRAINT tenaga_pengajar_pkey PRIMARY KEY (id);


--
-- TOC entry 3380 (class 2606 OID 18450)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3382 (class 2606 OID 18452)
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- TOC entry 3368 (class 2606 OID 18161)
-- Name: visi_misi visi_misi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi_misi
    ADD CONSTRAINT visi_misi_pkey PRIMARY KEY (id);


--
-- TOC entry 3394 (class 2606 OID 18594)
-- Name: visi_misi_tujuan visi_misi_tujuan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visi_misi_tujuan
    ADD CONSTRAINT visi_misi_tujuan_pkey PRIMARY KEY (id);


--
-- TOC entry 3405 (class 2606 OID 18120)
-- Name: layanan layanan_jenis_layanan_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.layanan
    ADD CONSTRAINT layanan_jenis_layanan_fkey FOREIGN KEY (jenis_layanan) REFERENCES public.jenis_layanan(id);


--
-- TOC entry 3406 (class 2606 OID 18125)
-- Name: link_sosial link_sosial_id_dosen_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.link_sosial
    ADD CONSTRAINT link_sosial_id_dosen_fkey FOREIGN KEY (id_dosen) REFERENCES public.dosen(id_dosen);


--
-- TOC entry 3407 (class 2606 OID 18130)
-- Name: mata_kuliah mata_kuliah_id_dosen_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mata_kuliah
    ADD CONSTRAINT mata_kuliah_id_dosen_fkey FOREIGN KEY (id_dosen) REFERENCES public.dosen(id_dosen);


--
-- TOC entry 3408 (class 2606 OID 18135)
-- Name: pendidikan pendidikan_id_dosen_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendidikan
    ADD CONSTRAINT pendidikan_id_dosen_fkey FOREIGN KEY (id_dosen) REFERENCES public.dosen(id_dosen);


--
-- TOC entry 3409 (class 2606 OID 18140)
-- Name: publikasi publikasi_id_dosen_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publikasi
    ADD CONSTRAINT publikasi_id_dosen_fkey FOREIGN KEY (id_dosen) REFERENCES public.dosen(id_dosen) ON DELETE CASCADE;


-- Completed on 2025-12-19 13:10:41

--
-- PostgreSQL database dump complete
--

\unrestrict TlAsFSKHzZc93unc8a5A306nlcJUUiLXwCOdsnHpQW0qsM5cerGVq24U8COj5fi

