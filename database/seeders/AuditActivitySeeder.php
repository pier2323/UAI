<?php

namespace Database\Seeders;

use App\Models\AuditActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows =  [
            [
                "code" => "2024-001",
                "description" => "Informe Definitivo 2019:PA:01 de fecha 06/11/2019, referido al Examen de la Cuenta 2017" ,
                "type_audit_id" => 7,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 6,
                "area" => "Medular",
                "objective" => 'Actuación de Seguimiento "Verificar el estado de implementación de las acciones correctivas presentadas por Cantv, con el fin de constatar su cumplimiento y eficacia en cuanto a subsanar las causas que dieron origen a las observaciones y/o hallazgos detectados en el Informe Definitivo 2019:PA:01 de fecha 06/11/2019, referido al Examen de la Cuenta 2017".'
            ],
            [
                "code" => "2024-002",
                "description" => 'Informe Definitivo 2019:OA:02 de fecha 27/12/2019, referido a Presentación de Cauciones 2018" ',
                "type_audit_id" => 7,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 6,
                "area" => "Apoyo",
                "objective" => 'Actuación de Seguimiento "Verificar el estado de implementación de las acciones correctivas presentadas por Cantv, con el fin de constatar su cumplimiento y eficacia en cuanto a subsanar las causas que dieron origen a las observaciones y/o hallazgos detectados en el Informe Definitivo 2019:OA:02 de fecha 27/12/2019, referido a Presentación de Cauciones 2018".'
            ],
            [
                "code" => "2024-003",
                "description" => 'Informe Definitivo 2019:PA:05 de fecha 27/12/2019, referido al Nivel de cumplimiento de la normativa relativa a la administración, fiscalización de los riesgos relacionados con los delitos de legitimación de capitales y financiamiento al terrorismo" ',
                "type_audit_id" => 7,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 6,
                "area" => "Medular",
                "objective" => 'Actuación de Seguimiento "Verificar el estado de implementación de las acciones correctivas presentadas por Cantv, con el fin de constatar su cumplimiento y eficacia en cuanto a subsanar las causas que dieron origen a las observaciones y/o hallazgos detectados en el Informe Definitivo 2019:PA:05 de fecha 27/12/2019, referido al Nivel de cumplimiento de la normativa relativa a la administración, fiscalización de los riesgos relacionados con los delitos de legitimación de capitales y financiamiento al terrorismo".'
            ],
            [
                "code" => "2024-004",
                "description" => 'Informe Definitivo 2021:PA:01 de fecha 27/10/2021, referido a Revisión Contratos Soporte y Mantenimiento Plataformas Satelitales"',
                "type_audit_id" => 7,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 6,
                "area" => "Medular",
                "objective" => 'Actuación de Seguimiento "Verificar el estado de implementación de las acciones correctivas presentadas por Cantv, con el fin de constatar su cumplimiento y eficacia en cuanto a subsanar las causas que dieron origen a las observaciones y/o hallazgos detectados en el Informe Definitivo 2021:PA:01 de fecha 27/10/2021, referido a Revisión Contratos Soporte y Mantenimiento Plataformas Satelitales".'
            ],
            [
                "code" => "2024-005",
                "description" => "Verificación acta de entrega de la Gerencia de Contrataciones Públicas  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Contrataciones Públicas adscrita a la Gerencia General de Consultoría Jurídica de la Cantv, correspondiente al servidor público saliente ciudadano Ronal Uzcategui Arias, titular de la cédula de identidad V-16.604.173, suscrita en fecha 01/08/2023".'
            ],
            [
                "code" => "2024-006",
                "description" => "Verificación acta de entrega de la Coordinación de Contrataciones Especiales  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Contrataciones Especiales adscrita a la Gerencia General de Consultoría Jurídica de la Cantv, correspondiente al servidora pública saliente ciudadana Jessika Alejandra Martinez Rodriguez, titular de la cédula de identidad V-18.369.348, suscrita en fecha 01/08/2023".'
            ],
            [
                "code" => "2024-007",
                "description" => "Verificación acta de entrega de la Coordinación de Garantías",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Garantías adscrita a la Gerencia General de Consultoría Jurídica de la Cantv, correspondiente al servidora pública saliente ciudadana Madelayne Coromoto Piñango Urbina, titular de la cédula de identidad V-20.219.153, suscrita en fecha 01/07/2023".'
            ],
            [
                "code" => "2024-008",
                "description" => "Verificación acta de entrega de la Gerencia de Mantenimiento Región Capital  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Mantenimiento Región Capital adscrita a la Gerencia General de Infraestructura de la Cantv, correspondiente al servidora pública saliente ciudadana Nathalye Carolina Lemos Gimón, titular de la cédula de identidad V-20.291.540, suscrita en fecha 31/07/2023".'
            ],
            [
                "code" => "2024-009",
                "description" => "Verificación acta de entrega de la Coordinación Centro Operación Sistemas Energía  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación Centro Operación Sistemas Energía adscrita a la Gerencia General Energía y Climatización de la Cantv, correspondiente al servidora pública saliente ciudadana Judith del Carmen Gimenez de Orozco, titular de la cédula de identidad V-5.540.845, suscrita en fecha 12/04/2023".'
            ],
            [
                "code" => "2024-010",
                "description" => "Verificación acta de entrega de la Coordinación de Monitoreo y Control  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Monitoreo y Control adscrita a la Gerente General Energía y Climatización de la Cantv, correspondiente al servidor público saliente ciudadano Michell Torres, titular de la cédula de identidad V-14.287.731, suscrita en fecha 11/08/2023".'
            ],
            [
                "code" => "2024-011",
                "description" => "Verificación acta de entrega de la Gerencia de Gestión de Procura  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Gestión de Procura adscrita a la Gerencia General Procura de la Cantv, correspondiente al servidora pública saliente ciudadana Evelin Artigas Cardea, titular de la cédula de identidad V-13.735.063, suscrita en fecha 14/08/2023".'
            ],
            [
                "code" => "2024-012",
                "description" => "Verificación acta de entrega de la Coordinación de Ventas Región Capital I  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 5,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Ventas Región Capital I adscrita a la Gerencia General Empresas e Instituciones Privadas de la Cantv, correspondiente al servidora pública saliente ciudadana Illenys Joselyn Gonzalez Luna, titular de la cédula de identidad V-13.162.760, suscrita en fecha 13/07/2023".'
            ],
            [
                "code" => "2024-013",
                "description" => "Verificación acta de entrega de la Coordinación Riesgos y Cobranzas  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 5,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación Riesgos y Cobranzas adscrita a la Gerencia general Mercados Masivos de la Cantv, correspondiente al servidor público saliente ciudadano Eduardo Elias Piñango Urbina, titular de la cédula de identidad V-16.745.996 suscrita en fecha 31/07/2023".'
            ],
            [
                "code" => "2024-014",
                "description" => "Verificación acta de entrega de la Coordinación Facturación y Analisis de Riesgo  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación Facturación y Analisis de Riesgo adscrita a la Gerencia General Empresas e Instituciones Privadas de la Cantv, correspondiente al servidor público saliente ciudadano Jorge Hernan Bedoya Gomez, titular de la cédula de identidad V-15.833.505, suscrita en fecha 04/07/2023".'
            ],
            [
                "code" => "2024-015",
                "description" => "Verificación acta de entrega de la Gerencia Servicios y Facilidades al Personal y Jubilado  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia Servicios y Facilidades al Personal y Jubilado adscrita a la Gerencia General Gestión Humana de la Cantv, correspondiente al servidora pública saliente ciudadana Erika Alejandra Bernal Martinez, titular de la cédula de identidad V-11.690.572, suscrita en fecha 25/08/2023".'
            ],
            [
                "code" => "2024-016",
                "description" => "Verificación acta de entrega de la Gerencia de Canales  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Canales adscrita a la Gerencia General Mercadeo Corporativo de la Cantv, correspondiente al servidor público saliente ciudadano Martin William Piñango De Chene, titular de la cédula de identidad V-14.727.634, suscrita en fecha 31/07/2023".'
            ],
            [
                "code" => "2024-017",
                "description" => "Verificación acta de entrega de la Coordinación Calidad de Canales  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación Calidad de Canales adscrita a la Gerencia General Mercadeo Corporativo de la Cantv, correspondiente al servidor público saliente ciudadano Johan Arnaldo Marrero Rivas titular de la cédula de identidad V-20.051.180, suscrita en fecha 31/07/2023".'
            ],
            [
                "code" => "2024-018",
                "description" => "Verificación acta de entrega de la Coordinación de Apoyo y Traslado  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " MAY ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Apoyo y Traslado adscrita a la Gerencia General Gestión de Flota de la Cantv, correspondiente al servidor público saliente ciudadano Johan Albertino Paredes Hukdhs, titular de la cédula de identidad V-17.410.183, suscrita en fecha 04/09/2023".'
            ],
            [
                "code" => "2024-019",
                "description" => "Verificar el cumplimiento de la obligación de prestar caución, que tienen los servidores públicos de la Cantv, encargados de la recepción, custodia y manejo de fondos y bienes,  ",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "Apoyo",
                "objective" => 'Actuación fiscal "Verificar el cumplimiento de la obligación de prestar caución, que tienen los servidores públicos de la Cantv, encargados de la recepción, custodia y manejo de fondos y bienes, correspondiente al ejercicio económico financiero 2023"'
            ],
            [
                "code" => "2024-020",
                "description" => "Evaluar los expedientes de las contrataciones de Bienes, Servicios y Obras realizadas por Cantv ",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 5,
                "area" => "Medular",
                "objective" => 'Actuación fiscal "Evaluar los expedientes de las contrataciones de Bienes, Servicios y Obras realizadas por Cantv, de conformidad con disposiciones legales y sublegales que rigen la materia, durante el ejercicio económico financiero 2023".'
            ],
            [
                "code" => "2024-021",
                "description" => "Verificar la gestión del proceso de Bienes Públicos de Cantv ",
                "type_audit_id" => 6,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 5,
                "area" => "Apoyo",
                "objective" => 'Actuación fiscal "Verificar la gestión del proceso de Bienes Públicos de Cantv, a través de la evaluación del cumplimiento de las normativas legales y sublegales que rigen la materia, durante el ejercicio económico financiero 2023".'
            ],
            [
                "code" => "2024-022",
                "description" => "Verificar el grado de conocimiento de los documentos normativos aprobados de las Unidades de la Vicepresidencia Ejecutiva de Cantv",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "Medular",
                "objective" => 'Actuación fiscal "Verificar el grado de conocimiento de los documentos normativos aprobados, que regulan los procesos realizados por las Dependencias adscritas a la Vicepresidencia Ejecutiva de Cantv"'
            ],
            [
                "code" => "2024-023",
                "description" => "Verificar el grado de conocimiento de los documentos normativos aprobados de las Unidades de la Vicepresidencia Prestación de Servicios de Cantv",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 5,
                "area" => "Medular",
                "objective" => 'Actuación fiscal "Verificar el grado de conocimiento de los documentos normativos aprobados, que regulan los procesos realizados por las Dependencias adscritas a la Vicepresidencia Prestación de Servicios de Cantv"'
            ],
            [
                "code" => "2024-024",
                "description" => "Verificar el grado de conocimiento de los documentos normativos aprobados de las Unidades de la Vicepresidencia Gestión Interna de Cantv",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "Medular",
                "objective" => 'Actuación fiscal "Verificar el grado de conocimiento de los documentos normativos aprobados, que regulan los procesos realizados por las Dependencias adscritas a la Vicepresidencia Gestión Interna de Cantv"'
            ],
            [
                "code" => "2024-025",
                "description" => "Verificar el grado de conocimiento de los documentos normativos aprobados de las Unidades de la Vicepresidencia Tecnología e Infraestructura de Cantv",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 4,
                "area" => "Medular",
                "objective" => 'Actuación fiscal "Verificar el grado de conocimiento de los documentos normativos aprobados, que regulan los procesos realizados por las Dependencias adscritas a la Vicepresidencia Tecnología e Infraestructura de Cantv"'
            ],
            [
                "code" => "2024-026",
                "description" => "Verificar la razonabilidad del saldo de las cuentas por pagar de Cantv ",
                "type_audit_id" => 3,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "Apoyo",
                "objective" => 'Actuación fiscal "Verificar la razonabilidad del saldo de las cuentas por pagar de Cantv, correspondiente al ejercicio económico financiero 2023".'
            ],
            [
                "code" => "2024-027",
                "description" => "Verificar la razonabilidad del saldo de las cuentas por cobrar de Cantv ",
                "type_audit_id" => 3,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "Apoyo",
                "objective" => 'Actuación fiscal "Verificar la razonabilidad del saldo de las cuentas por cobrar de Cantv, correspondiente al ejercicio económico financiero 2023".'
            ],
            [
                "code" => "2024-028",
                "description" => "Inspección de las Condiciones y Seguridad de las Instalaciones del Almacén de Cantv, ubicado en Valencia, Estado Carabobo ",
                "type_audit_id" => 5,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "Inspección, Verificación y/o Revisión",
                "objective" => 'Actuación fiscal "Inspección de las Condiciones y Seguridad de las Instalaciones del Almacén de Cantv, ubicado en Valencia, Estado Carabobo"'
            ],
            [
                "code" => "2024-029",
                "description" => "Verificar las existencias de materiales y equipos, ubicados en el Almacen de Cantv, Valencia, Estado Carabobo ",
                "type_audit_id" => 4,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 5,
                "area" => "Inventario",
                "objective" => 'Actuación fiscal "Verificar la exactitud y sinceridad de las existencias de materiales y equipos, ubicados en el Almacen de Cantv, Valencia, Estado Carabobo, correspondiente al ejercicio económico financiero 2024"'
            ],
            [
                "code" => "2024-030",
                "description" => "Evaluar el registro de proveedores de Cantv ",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 5,
                "area" => "Apoyo",
                "objective" => 'Actuación fiscal "Evaluar el registro de proveedores de Cantv, de conformidad con disposiciones legales y sublegales que rigen la materia, durante el ejercicio económico financiero 2023".'
            ],
            [
                "code" => "2024-031",
                "description" => "Evaluar la legalidad, sinceridad y exactitud en la administración y cierre de los contratos, suscritos entre Cantv y las empresas contratistas que intervinieron en el Proyecto Televisión Digital Abierta (TDA),  ",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "Medular",
                "objective" => 'Actuación fiscal "Evaluar la legalidad, sinceridad y exactitud en la administración y cierre de los contratos, suscritos entre Cantv y las empresas contratistas que intervinieron en el Proyecto Televisión Digital Abierta (TDA), correspondiente a  los ejercicios económicos financieros 2012 al 2023".'
            ],
            [
                "code" => "2024-032",
                "description" => "Evaluar la adquisición, factibilidad y puesta en producción del Sistema de Información Geográfico (GIS),  ",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 4,
                "area" => "Medular",
                "objective" => 'Actuación fiscal "Evaluar la adquisición, factibilidad y puesta en producción del Sistema de Información Geográfico (GIS), correspondiente a los ejercicios económicos financieros 2021 al 2023"'
            ],
            [
                "code" => "2024-033",
                "description" => "Informe Definitivo 2021:PA:02 de fecha 14/09/2021, referido a Examen de la Cuenta 2018",
                "type_audit_id" => 7,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "Medular",
                "objective" => 'Actuación de Seguimiento "Verificar el estado de implementación de las acciones correctivas presentadas por Cantv, con el fin de constatar su cumplimiento y eficacia en cuanto a subsanar las causas que dieron origen a las observaciones y/o hallazgos detectados en el Informe Definitivo 2021:PA:02 de fecha 14/09/2021, referido al Examen de la Cuenta 2018".'
            ],
            [
                "code" => "2024-034",
                "description" => "Informe Definitivo 2021:PA:03 de fecha 14/12/2021, referido a Infraestructura del Sistema Automatizado de Averias SACAS, en el marco de la nueva normalidad",
                "type_audit_id" => 7,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "Medular",
                "objective" => 'Actuación de Seguimiento "Verificar el estado de implementación de las acciones correctivas presentadas por Cantv, con el fin de constatar su cumplimiento y eficacia en cuanto a subsanar las causas que dieron origen a las observaciones y/o hallazgos detectados en el Informe Definitivo 2021:PA:03 de fecha 14/12/2021, referido a la Infraestructura del Sistema Automatizado de Averías SACAS, en el marco de la nueva normalidad".'
            ],
            [
                "code" => "2024-035",
                "description" => "Informe Definitivo 2021:AE:01 de fecha 29/06/2021, referido a Presentación de Cauciones 2019 hasta agosto 2020",
                "type_audit_id" => 7,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "Apoyo",
                "objective" => 'Actuación de Seguimiento "Verificar el estado de implementación de las acciones correctivas presentadas por Cantv, con el fin de constatar su cumplimiento y eficacia en cuanto a subsanar las causas que dieron origen a las observaciones y/o hallazgos detectados en el Informe Definitivo 2021:AE:01 de fecha 29/06/2021, referido a Presentación de Cauciones 2019 hasta agosto 2020".'
            ],
            [
                "code" => "2024-036",
                "description" => "Verificación acta de entrega de la Coordinación de Emergencias y Atención al Usuario  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Emergencias y Atención al Usuario adscrita a la Gerencia General Gestión Humana de la Cantv, correspondiente a la servidora pública saliente ciudadana Padilla Betancourt Leisalien, titular de la cédula de identidad V-17.387.959, suscrita en fecha 31/08/2023".'
            ],
            [
                "code" => "2024-037",
                "description" => "Verificación acta de entrega de la Coordinación Certificación Seguridad de Productos  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 5,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación Certificación Seguridad de Productos adscrita a la Gerencia General Seguridad Integral de la Cantv, correspondiente al servidor público saliente ciudadano Fernando Augusto Mijares Vegas, titular de la cédula de identidad V-15.700.709, suscrita en fecha 01/09/2023".'
            ],
            [
                "code" => "2024-038",
                "description" => "Verificación acta de entrega de la Coordinación Administración de Formación  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación Administración de Formación adscrita a la Gerencia General Gestión Humana de la Cantv, correspondiente a la servidora pública saliente ciudadana Inis Guerra Arguello, titular de la cédula de identidad V-14.428.201, suscrita en fecha 31/08/2023".'
            ],
            [
                "code" => "2024-039",
                "description" => "Verificación acta de entrega de la Coordinación Asuntos Contenciosos  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación Asuntos Contenciosos adscrita a la Gerencia General Consultoría Jurídica de la Cantv, correspondiente al servidor público saliente ciudadano Jesuant Gerardo Silva Velasco, titular de la cédula de identidad V-17.691.479, suscrita en fecha 18/09/2023".'
            ],
            [
                "code" => "2024-040",
                "description" => "Verificación acta de entrega de la Coordinación de Relaciones con la Comunidad  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Relaciones con la Comunidad adscrita a la Gerencia General Comunicaciones y Asuntos Públicos de la Cantv, correspondiente a la servidora pública saliente ciudadana Sharira Duarte, titular de la cédula de identidad V-12.017.287, suscrita en fecha 07/08/2023".'
            ],
            [
                "code" => "2024-041",
                "description" => "Verificación acta de entrega de la Coordinación de Información Interna  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Información Interna adscrita a la Gerencia General Comunicaciones y Asuntos Públicos de la Cantv, correspondiente a la servidora pública saliente ciudadana Venezuela Dianorak Delgado Fagundez, titular de la cédula de identidad V-17.058.799, suscrita en fecha 08/09/2023".'
            ],
            [
                "code" => "2024-042",
                "description" => "Verificación acta de entrega de la Gerencia de Planificación de Redes  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Planificación de Redes adscrita a la Gerencia General Planificación Tecnologica de la Cantv, correspondiente al servidor público saliente ciudadano Eudis Jesús Golindano Arellano, titular de la cédula de identidad V-9.996.537, suscrita en fecha 02/10/2023".'
            ],
            [
                "code" => "2024-043",
                "description" => "Verificación acta de entrega de la Coordinación de Seguimiento y Cierre de Contratos  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 6,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Seguimiento y Cierre de Contratos adscrita a la Gerencia General Energía y Climatización de la Cantv, correspondiente a la servidora pública saliente ciudadana Yelitza Perez Solarte, titular de la cédula de identidad V-11.557.814, suscrita en fecha 13/10/2023".'
            ],
            [
                "code" => "2024-044",
                "description" => "Verificación acta de entrega de la Gerencia de Planificación y Control  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Planificación y Control adscrita a la Gerencia General Gestión de Flota de la Cantv, correspondiente a la servidora pública saliente ciudadana Arlene Joselyn, titular de la cédula de identidad V-16.903.427, suscrita en fecha 02/11/2023".'
            ],
            [
                "code" => "2024-045",
                "description" => "Verificación acta de entrega de la gerencia de Planificación Administración y Control de Gestión  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la gerencia de Planificación Administración y Control de Gestión adscrita a la Gerencia General para el Fortalecimiento del Poder Popular de la Cantv, correspondiente al servidor público saliente ciudadano Gilberto Perez Maestre, titular de la cédula de identidad V-8.751.257, suscrita en fecha 03/11/2023".'
            ],
            [
                "code" => "2024-046",
                "description" => "Verificación acta de entrega de la Coordinación Planificación Presupuesto y Control de Gestión  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación Planificación Presupuesto y Control de Gestión adscrita a la Gerencia General Gestión Humana de la Cantv, correspondiente a la servidora pública saliente ciudadana Reyes Nadia Margaret, titular de la cédula de identidad V-17.857.593, suscrita en fecha 01/11/2023".'
            ],
            [
                "code" => "2024-047",
                "description" => "Verificación acta de entrega de la Gerencia Gestión Judicial  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia Gestión Judicial adscrita a la Gerencia General Consultoría Jurídica de la Cantv, correspondiente al servidor público saliente ciudadano Jaiker José Mendoza Regalado, titular de la cédula de identidad V-6.552.759, suscrita en fecha 31/10/2023".'
            ],
            [
                "code" => "2024-048",
                "description" => "Verificación acta de entrega de la Coordinación de Aseguramiento de la Calidad  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Aseguramiento de la Calidad adscrita a la Gerencia General Mercados Masivos de la Cantv, correspondiente a la servidora pública saliente ciudadana Yraida Gavidia Escalona, titular de la cédula de identidad V-10.529.656, suscrita en fecha 16/11/2023".'
            ],
            [
                "code" => "2024-049",
                "description" => "Verificación acta de entrega de la Coordinación de Planificación y Control  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Planificación y Control adscrita a la Gerencia General de Consultoría Jurídica de la Cantv, correspondiente a la servidora pública saliente ciudadana Luisana Avila Guzman, titular de la cédula de identidad V-12.357.772, suscrita en fecha 04/09/2023".'
            ],
            [
                "code" => "2024-050",
                "description" => "Verificación acta de entrega de la Gerente Seguridad de la Operación y Servicios  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerente Seguridad de la Operación y Servicios adscrita a la Gerencia General de Seguridad Integral, correspondiente al servidor público saliente ciudadano Pedro Armando Fernandez Rodriguez, titular de la cédula de identidad V-5.542.100, suscrita en fecha 17/11/2023".'
            ],
            [
                "code" => "2024-051",
                "description" => "Evaluar la legalidad, exactitud y sinceridad de la cuenta de Gastos, Ingresos y Bienes, a los fines de su calificación ",
                "type_audit_id" => 9,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 7,
                "area" => "Medular",
                "objective" => 'Actuación fiscal “Evaluar la legalidad, exactitud y sinceridad de la cuenta de Gastos, Ingresos y Bienes, a los fines de su calificación, en el marco de las disposiciones legales y reglamentarias que rigen el Examen de la Cuenta, correspondiente al ejercicio económico financiero 2022".'
            ],
            [
                "code" => "2024-052",
                "description" => " valuar, la legalidad, sinceridad y exactitud en el proceso de adjudicación, contratación directa y administración de con ",
                "type_audit_id" => 2,
                "month_start" => "FEB",
                "month_end" => " AGO ",
                "uai_id" => 5,
                "area" => "",
                "objective" => 'Actuación fiscal "Evaluar la legalidad, sinceridad y exactitud en el proceso de adjudicación, contratación directa y administración de contratos suscrito entre Cantv y la empresa ASSIAH, C.A., por el servicio de mantenimiento y soporte técnico, remoto y local de las licencias de los productos AVEN AID, FILE AID MVS y THRUPUT MANAGER, en la región capital, para los años 2020-2021".'
            ],
            [
                "code" => "2024-053",
                "description" => "Verificación acta de entrega de la Gerencia Operación y Mantenimiento Region Andes  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia Operación y Mantenimiento Region Andes adscrita a la Gerencia General de Energía y Climatizacion de la Cantv, correspondiente al servidor público saliente ciudadano Antonio Rafael Carrasquero Florez, titular de la cédula de identidad V-16.223.662, suscrita en fecha 21/11/2023".'
            ],
            [
                "code" => "2024-054",
                "description" => "Verificación acta de entrega de la Vicepresidencia de Tecnologia e Infraestructura  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Vicepresidencia de Tecnologia e Infraestructura adscrita a la Presidencia de la Cantv, correspondiente al servidor público saliente ciudadano Francisco Javier Masso Carrera, titular de la cédula de identidad V-14.355.819, suscrita en fecha 15/12/2023".'
            ],
            [
                "code" => "2024-055",
                "description" => "Verificación acta de entrega de la Coordinación de Asuntos Penales Regionales  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 6,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Asuntos Penales Regionales adscrita a la Gerencia de Gestión Judicial de la Cantv, correspondiente al servidor público saliente ciudadano Jaiker José Mendoza Regalado, titular de la cédula de identidad V-6.552.759, suscrita en fecha 11/12/2023".'
            ],
            [
                "code" => "2024-056",
                "description" => "Verificación acta de entrega de la Gerencia de Seguimiento y Control de Sistemas  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Seguimiento y Control de Sistemas adscrita a la Gerencia General de Seguimiento y Control  Integral de la Gestión de la Cantv, correspondiente al servidor público saliente ciudadano Juan Carlos Monsalve Sarmiento, titular de la cédula de identidad V-12.293.445, suscrita en fecha 27/12/2023".'
            ],
            [
                "code" => "2024-057",
                "description" => "Verificación acta de entrega de la Vicepresidencia Ejecutiva  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 5,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Vicepresidencia Ejecutiva adscrita a la Presidencia de la Cantv, correspondiente al servidor público saliente ciudadano Feliz Omar Velásquez Landoni, titular de la cédula de identidad V-11.665.812, suscrita en fecha 02/01/2024".'
            ],
            [
                "code" => "2024-058",
                "description" => "Verificación acta de entrega de la Coordinación de Administracion y Control de Canales  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 6,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Coordinación de Administracion y Control de Canales adscrita a la Gerencia General de Empresas e instituciones Privadas de la Cantv, correspondiente a la servidora pública saliente ciudadana Josmary Carrillo Calzadilla, titular de la cédula de identidad V-7.196.090, suscrita en fecha 02/10/2023".'
            ],
            [
                "code" => "2024-059",
                "description" => "Verificación acta de entrega de la Gerencia Gestion de Procura  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 7,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia Gestion de Procura adscrita a la Gerencia General de Procura de la Cantv, correspondiente a la servidora pública saliente ciudadana Evelin Carolina Artigas C., titular de la cédula de identidad V-13.735.063, suscrita en fecha 25/01/2024".'
            ],
            [
                "code" => "2024-060",
                "description" => "Verificación acta de entrega de la Gerencia de Servicios y Ventas Fuerzas Productivas Región Centro  ",
                "type_audit_id" => 1,
                "month_start" => "FEB",
                "month_end" => " OCT ",
                "uai_id" => 4,
                "area" => "",
                "objective" => 'Actuación fiscal "Verificación de la sinceridad y exactitud del contenido del acta de entrega de la Gerencia de Servicios y Ventas Fuerzas Productivas Región Centro adscrita a la Gerencia General de Empresas e Instituciones Privadas de la Cantv, correspondiente a la servidora pública saliente ciudadana Maria del Rosario Da Rocha Oliveira, titular de la cédula de identidad V-12.142.332, suscrita en fecha 17/01/2024".'

             ]
        ];

        foreach ($rows as $row) {   
            $auditActivity = new AuditActivity();
            $auditActivity->code = $row['code'];
            $auditActivity->area = $row['area'];
            $auditActivity->description = $row['description'];
            $auditActivity->objective = $row['objective'];
            $auditActivity->month_start = $row['month_start'];
            $auditActivity->month_end = $row['month_end'];
            $auditActivity->type_audit_id = $row['type_audit_id'];
            $auditActivity->uai_id = $row['uai_id'];
            $auditActivity->save();
        }
    }
}
