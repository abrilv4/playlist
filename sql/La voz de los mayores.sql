/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     6/4/2022 08:52:23                            */
/*==============================================================*/


drop table if exists AUDIOLIBRO;

drop table if exists HISTORIA;

drop table if exists MUSICA;

drop table if exists PERTENECE;

drop table if exists PLAYLIST;

drop table if exists USUARIOS;

/*==============================================================*/
/* Table: AUDIOLIBRO                                            */
/*==============================================================*/
create table AUDIOLIBRO
(
   ID_AL                int auto_increment not null,
   ID_U                 int,
   NOMBRE_AL            varchar(50) not null,
   AUTOR_AL             varchar(50) not null,
   NARRADOR_AL          varchar(50) not null,
   CATEGORIA_AL         varchar(50) not null,
   FECHAPUBLICACION_AL  date not null,
   ENLACE_AL            varchar(150) not null,
   primary key (ID_AL)
);

/*==============================================================*/
/* Table: HISTORIA                                              */
/*==============================================================*/
create table HISTORIA
(
   ID_H                 int auto_increment not null,
   ID_U                 int,
   TITULO_H             varchar(50) not null,
   DESCRIPCION_H        varchar(200) not null,
   ENLACE_H             varchar(150) not null,
   primary key (ID_H)
);

/*==============================================================*/
/* Table: MUSICA                                                */
/*==============================================================*/
create table MUSICA
(
   ID_M                 int auto_increment not null,
   NOMBRE_M             varchar(50) not null,
   AUTOR_M              varchar(50) not null,
   ENLACE_M             varchar(150) not null,
   CATEGORIA_M          varchar(50) not null,
   FECHAPUBLICACION_M   date not null,
   primary key (ID_M)
);

/*==============================================================*/
/* Table: PERTENECE                                             */
/*==============================================================*/
create table PERTENECE
(
   ID_M                 int not null,
   ID_P                 int not null,
   primary key (ID_M, ID_P)
);

/*==============================================================*/
/* Table: PLAYLIST                                              */
/*==============================================================*/
create table PLAYLIST
(
   ID_P                 int auto_increment not null,
   ID_U                 int,
   NOMBRE_P             varchar(50) not null,
   DESCRIPCION_P        varchar(200),
   primary key (ID_P)
);

/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS
(
   ID_U                 int auto_increment not null,
   NOMBRE_U             char(50) not null,
   CONTRASENIA_U        varchar(20) not null,
   CORREO_U             varchar(100),
   primary key (ID_U)
);

alter table AUDIOLIBRO add constraint FK_SUBE foreign key (ID_U)
      references USUARIOS (ID_U);

alter table HISTORIA add constraint FK_CUENTA foreign key (ID_U)
      references USUARIOS (ID_U);

alter table PERTENECE add constraint FK_PERTENECE foreign key (ID_M)
      references MUSICA (ID_M);

alter table PERTENECE add constraint FK_PERTENECE2 foreign key (ID_P)
      references PLAYLIST (ID_P);

alter table PLAYLIST add constraint FK_CREA foreign key (ID_U)
      references USUARIOS (ID_U);

