alter table public.area_deportiva_cerrada
drop constraint area_deportiva_cerrada_id_espacio_fkey,
add constraint area_deportiva_cerrada_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.auditorio
drop constraint auditorio_id_espacio_fkey,
add constraint auditorio_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.bano
drop constraint bano_id_espacio_fkey,
add constraint bano_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.bodega
drop constraint bodega_id_espacio_fkey,
add constraint bodega_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.campus
drop constraint campus_sede_fkey,
add constraint campus_sede_fkey
   foreign key (sede)
   references sede(id)
   on update cascade 
   on delete cascade;

alter table public.campus_archivos
drop constraint campus_archivos_id_sede_fkey,
add constraint campus_archivos_id_sede_fkey
   foreign key (id_sede, id_campus)
   references campus(sede, id)
   on update cascade 
   on delete cascade;

alter table public.cancha
drop constraint cancha_id_campus_fkey,
add constraint cancha_id_campus_fkey
   foreign key (id_campus, id_sede)
   references campus(id, sede)
   on update cascade 
   on delete cascade;

alter table public.cancha_archivos
drop constraint cancha_archivos_id_sede_fkey,
add constraint cancha_archivos_id_fkey
   foreign key (id_sede, id_campus, id)
   references cancha(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.centro_datos
drop constraint centro_datos_id_espacio_fkey,
add constraint centro_datos_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.cocineta
drop constraint cocineta_id_espacio_fkey,
add constraint cocineta_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.corredor
drop constraint corredor_id_campus_fkey,
add constraint corredor_id_campus_fkey
   foreign key (id_campus, id_sede)
   references campus(id, sede)
   on update cascade 
   on delete cascade;

alter table public.corredor_archivos
drop constraint corredor_archivos_id_fkey,
add constraint corredor_archivos_id_fkey
   foreign key (id_sede, id_campus, id)
   references corredor(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.cuarto_aire_acondicionado
drop constraint cuarto_aire_acondicionado_id_espacio_fkey,
add constraint cuarto_aire_acondicionado_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.cuarto_bombas
drop constraint cuarto_bombas_id_espacio_fkey,
add constraint cuarto_bombas_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.cuarto_plantas
drop constraint cuarto_plantas_id_espacio_fkey,
add constraint cuarto_plantas_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.cuarto_tecnico
drop constraint cuarto_tecnico_id_espacio_fkey,
add constraint cuarto_tecnico_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.cubiertas_piso
drop constraint cubiertas_piso_id_edificio_fkey,
add constraint cubiertas_piso_id_edificio_fkey
   foreign key (id_sede, id_campus, id_edificio)
   references edificio(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.cubiertas_piso_archivos
drop constraint cubiertas_piso_archivos_id_sede_fkey,
add constraint cubiertas_piso_archivos_id_sede_fkey
   foreign key (id_sede, id_campus, id_edificio, piso)
   references cubiertas_piso(id_sede, id_campus, id_edificio, piso)
   on update cascade 
   on delete cascade;

alter table public.edificio
drop constraint edificio_id_campus_fkey,
add constraint edificio_id_campus_fkey
   foreign key (id_sede, id_campus)
   references campus(sede, id)
   on update cascade 
   on delete cascade;

alter table public.edificio_archivos
drop constraint edificio_archivos_id_sede_fkey,
add constraint edificio_archivos_id_sede_fkey
   foreign key (id_sede, id_campus, id_edificio)
   references edificio(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.espacio
drop constraint edificio_fk,
add constraint espacio_id_edificio_fkey
   foreign key (id_sede, id_campus, id_edificio)
   references edificio(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;


alter table public.espacio
drop constraint espacio_padre_fk,
add constraint espacio_id_espacio_fkey
   foreign key (sede_padre, campus_padre, edificio_padre, espacio_padre)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.espacio_archivos
drop constraint espacio_archivos_id_espacio_fkey,
add constraint espacio_archivos_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.gradas
drop constraint gradas_id_edificio_fkey,
add constraint gradas_id_edificio_fkey
   foreign key (id_sede, id_campus, id_edificio)
   references edificio(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.gradas_archivos
drop constraint gradas_archivos_piso_fkey,
add constraint gradas_archivos_piso_fkey
   foreign key (id_sede, id_campus, id_edificio, piso)
   references gradas(id_sede, id_campus, id_edificio, piso_inicio)
   on update cascade 
   on delete cascade;

alter table public.iluminacion_corredor
drop constraint corredor_fk,
add constraint iluminacion_corredor_id_corredor_fkey
   foreign key (id_sede, id_campus, id)
   references corredor(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.iluminacion_espacio
drop constraint iluminacion_espacio_id_espacio_fkey,
add constraint iluminacion_espacio_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.iluminacion_plazoleta
drop constraint plazoleta_fk,
add constraint iluminacion_plazoleta_id_plazoleta_fkey
   foreign key (id_sede, id_campus, id)
   references plazoleta(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.interruptor_corredor
drop constraint corredor_fk,
add constraint interruptor_corredor_id_corredor_fkey
   foreign key (id_sede, id_campus, id)
   references corredor(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.interruptor_espacio
drop constraint interruptor_espacio_id_espacio_fkey,
add constraint interruptor_espacio_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.laboratorio
drop constraint laboratorio_id_espacio_fkey,
add constraint laboratorio_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.lavamanos_bano
drop constraint lavamanos_bano_id_espacio_fkey,
add constraint lavamanos_bano_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.oficina
drop constraint oficina_id_espacio_fkey,
add constraint oficina_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.orinal_bano
drop constraint orinal_bano_id_espacio_fkey,
add constraint orinal_bano_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.parqueadero
drop constraint parqueadero_id_campus_fkey,
add constraint parqueadero_id_campus_fkey
   foreign key (id_sede, id_campus)
   references campus(sede, id)
   on update cascade 
   on delete cascade;

alter table public.parqueadero_archivos
drop constraint parqueadero_fk,
add constraint parqueadero_id_parqueadero_fkey
   foreign key (id_sede, id_campus, id)
   references parqueadero(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.piscina
drop constraint piscina_id_campus_fkey,
add constraint piscina_id_campus_fkey
   foreign key (id_sede, id_campus)
   references campus(sede, id)
   on update cascade 
   on delete cascade;

alter table public.piscina_archivos
drop constraint piscina_fk,
add constraint piscina_id_piscina_fkey
   foreign key (id_sede, id_campus, id)
   references piscina(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.plazoleta
drop constraint plazoleta_id_campus_fkey,
add constraint plazoleta_id_campus_fkey
   foreign key (id_sede, id_campus)
   references campus(sede, id)
   on update cascade 
   on delete cascade;

alter table public.plazoleta_archivos
drop constraint plazoleta_fk,
add constraint plazoleta_id_plazoleta_fkey
   foreign key (id_sede, id_campus, id)
   references plazoleta(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.puerta_espacio
drop constraint puerta_espacio_id_espacio_fkey,
add constraint puerta_espacio_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.puerta_tipo_cerradura
drop constraint puerta_tipo_cerradura_id_sede_fkey,
add constraint puerta_tipo_cerradura_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio, id_tipo_puerta, id_material_puerta, id_material_marco)
   references puerta_espacio(id_sede, id_campus, id_edificio, id_espacio, id_tipo_puerta, id_material_puerta, id_material_marco)
   on update cascade 
   on delete cascade;

alter table public.punto_sanitario
drop constraint punto_sanitario_id_espacio_fkey,
add constraint punto_sanitario_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.sala_computo
drop constraint sala_computo_id_espacio_fkey,
add constraint sala_computo_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.sala_estudio
drop constraint sala_estudio_id_espacio_fkey,
add constraint sala_estudio_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.salon
drop constraint salon_id_espacio_fkey,
add constraint salon_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.sendero
drop constraint sendero_id_campus_fkey,
add constraint sendero_id_campus_fkey
   foreign key (id_sede, id_campus)
   references campus(sede, id)
   on update cascade 
   on delete cascade;

alter table public.sendero_archivos
drop constraint sendero_fk,
add constraint sendero_archivos_id_sendero_fkey
   foreign key (id_sede, id_campus, id)
   references sendero(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;

alter table public.suministro_energia_espacio
drop constraint suministro_energia_espacio_id_espacio_fkey,
add constraint suministro_energia_espacio_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.ventana_espacio
drop constraint ventana_espacio_id_espacio_fkey,
add constraint ventana_espacio_id_espacio_fkey
   foreign key (id_sede, id_campus, id_edificio, id_espacio)
   references espacio(id_sede, id_campus, id_edificio, id)
   on update cascade 
   on delete cascade;

alter table public.ventana_gradas
drop constraint gradas_fk,
add constraint ventana_gradas_id_gradas_fkey
   foreign key (id_sede, id_campus, id_edificio, piso_inicio)
   references gradas(id_sede, id_campus, id_edificio, piso_inicio)
   on update cascade 
   on delete cascade;

alter table public.via
drop constraint via_id_campus_fkey,
add constraint via_id_campus_fkey
   foreign key (id_sede, id_campus)
   references campus(sede, id)
   on update cascade 
   on delete cascade;

alter table public.via_archivos
drop constraint via_fk,
add constraint via_archivos_id_via_fkey
   foreign key (id_sede, id_campus, id)
   references via(id_sede, id_campus, id)
   on update cascade 
   on delete cascade;