<?php

//
//  Copyright (C) 2014 by Jackie Ng
//
//  This library is free software; you can redistribute it and/or
//  modify it under the terms of version 2.1 of the GNU Lesser
//  General Public License as published by the Free Software Foundation.
//
//  This library is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
//  Lesser General Public License for more details.
//
//  You should have received a copy of the GNU Lesser General Public
//  License along with this library; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
//

require_once dirname(__FILE__)."/../../controller/coordinatesystemcontroller.php";
require_once dirname(__FILE__)."/../../controller/resourceservicecontroller.php";
require_once dirname(__FILE__)."/../../controller/mappingservicecontroller.php";
require_once dirname(__FILE__)."/../../controller/restservicecontroller.php";

/**
 * @SWG\Resource(
 *      apiVersion="1.0",
 *      swaggerVersion="1.2",
 *      description="Additional Services",
 *      resourcePath="/services"
 * )
 */

/**
 * @SWG\Api(
 *     path="/services/fusiontemplates",
 *     @SWG\Operation(
 *        method="GET",
 *        nickname="EnumerateApplicationTemplates",
 *        summary="Enumerates available templates for a fusion application",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="query", required=false, type="string", description="Your MapGuide Session ID")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->get("/services/fusiontemplates", function() use ($app) {
    $ctrl = new MgRestServiceController($app);
    $ctrl->EnumerateApplicationTemplates("xml");
});
/**
 * @SWG\Api(
 *     path="/services/fusiontemplates.{type}",
 *     @SWG\Operation(
 *        method="GET",
 *        nickname="EnumerateApplicationTemplates",
 *        summary="Enumerates available templates for a fusion application",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="query", required=false, type="string", description="Your MapGuide Session ID"),
 *          @SWG\parameter(name="type", paramType="path", required=true, type="string", description="xml or json", enum="['xml','json']")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->get("/services/fusiontemplates.:format", function($format) use ($app) {
    $ctrl = new MgRestServiceController($app);
    $ctrl->EnumerateApplicationTemplates($format);
});
/**
 * @SWG\Api(
 *     path="/services/fusionwidgets",
 *     @SWG\Operation(
 *        method="GET",
 *        nickname="EnumerateApplicationWidgets",
 *        summary="Enumerates available widgets for a fusion application",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="query", required=false, type="string", description="Your MapGuide Session ID")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->get("/services/fusionwidgets", function() use ($app) {
    $ctrl = new MgRestServiceController($app);
    $ctrl->EnumerateApplicationWidgets("xml");
});
/**
 * @SWG\Api(
 *     path="/services/fusionwidgets.{type}",
 *     @SWG\Operation(
 *        method="GET",
 *        nickname="EnumerateApplicationWidgets",
 *        summary="Enumerates available widgets for a fusion application",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="query", required=false, type="string", description="Your MapGuide Session ID"),
 *          @SWG\parameter(name="type", paramType="path", required=true, type="string", description="xml or json", enum="['xml','json']")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->get("/services/fusionwidgets.:format", function($format) use ($app) {
    $ctrl = new MgRestServiceController($app);
    $ctrl->EnumerateApplicationWidgets($format);
});
/**
 * @SWG\Api(
 *     path="/services/fusioncontainers",
 *     @SWG\Operation(
 *        method="GET",
 *        nickname="EnumerateApplicationContainers",
 *        summary="Enumerates available containers for a fusion application",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="query", required=false, type="string", description="Your MapGuide Session ID")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->get("/services/fusioncontainers", function() use ($app) {
    $ctrl = new MgRestServiceController($app);
    $ctrl->EnumerateApplicationContainers("xml");
});
/**
 * @SWG\Api(
 *     path="/services/fusioncontainers.{type}",
 *     @SWG\Operation(
 *        method="GET",
 *        nickname="EnumerateApplicationContainers",
 *        summary="Enumerates available containers for a fusion application",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="query", required=false, type="string", description="Your MapGuide Session ID"),
 *          @SWG\parameter(name="type", paramType="path", required=true, type="string", description="xml or json", enum="['xml','json']")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->get("/services/fusioncontainers.:format", function($format) use ($app) {
    $ctrl = new MgRestServiceController($app);
    $ctrl->EnumerateApplicationContainers($format);
});
/**
 * @SWG\Api(
 *     path="/services/listunmanageddata.{responseType}",
 *     @SWG\Operation(
 *        method="POST",
 *        nickname="EnumerateUnmanagedData",
 *        summary="Enumerates files in an unmanaged aliased directory",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="form", required=false, type="string", description="Your MapGuide Session ID"),
 *          @SWG\parameter(name="path", paramType="form", required=false, type="string", description=""),
 *          @SWG\parameter(name="type", paramType="form", required=true, type="string", description="", enum="['Folders','Files','Both']"),
 *          @SWG\parameter(name="filter", paramType="form", required=false, type="string", description=""),
 *          @SWG\parameter(name="recursive", paramType="form", required=true, type="boolean", description=""),
 *          @SWG\parameter(name="responseType", paramType="path", required=true, type="string", description="xml or json", enum="['xml','json']")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->post("/services/listunmanageddata.:format", function($format) use ($app) {
    $ctrl = new MgResourceServiceController($app);
    $ctrl->EnumerateUnmanagedData($format);
});
/**
 * @SWG\Api(
 *     path="/services/getschemamapping",
 *     @SWG\Operation(
 *        method="GET",
 *        nickname="GetSchemaMapping",
 *        summary="Gets schema mapping of a feature source",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="query", required=false, type="string", description="Your MapGuide Session ID"),
 *          @SWG\parameter(name="provider", paramType="query", required=true, type="string", description="The FDO Provider"),
 *          @SWG\parameter(name="connection", paramType="query", required=true, type="string", description="The partial connection string")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->get("/services/getschemamapping", function() use ($app) {
    $ctrl = new MgFeatureServiceController($app);
    $ctrl->GetSchemaMapping("xml");
});
/**
 * @SWG\Api(
 *     path="/services/getschemamapping.{type}",
 *     @SWG\Operation(
 *        method="GET",
 *        nickname="GetSchemaMapping",
 *        summary="Gets schema mapping of a feature source",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="query", required=false, type="string", description="Your MapGuide Session ID"),
 *          @SWG\parameter(name="provider", paramType="query", required=true, type="string", description="The FDO Provider"),
 *          @SWG\parameter(name="connection", paramType="query", required=true, type="string", description="The partial connection string"),
 *          @SWG\parameter(name="type", paramType="path", required=true, type="string", description="xml or json", enum="['xml','json']")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->get("/services/getschemamapping.:format", function($format) use ($app) {
    $ctrl = new MgFeatureServiceController($app);
    $ctrl->GetSchemaMapping($format);
});

/**
 * @SWG\Api(
 *     path="/services/copyresource",
 *     @SWG\Operation(
 *        method="POST",
 *        nickname="CopyResource",
 *        summary="Copies a resource from one resource ID to another",
 *        @SWG\parameters(
 *          @SWG\parameter(name="source", paramType="form", required=true, type="string", description="The Source Resource ID"),
 *          @SWG\parameter(name="destination", paramType="form", required=true, type="string", description="The Target Resource ID"),
 *          @SWG\parameter(name="overwrite", paramType="form", required=false, type="boolean", description="Indicates whether to overwrite the target resource if it exists")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->post("/services/copyresource", function() use ($app) {
    $ctrl = new MgResourceServiceController($app);
    $ctrl->CopyResource();
});
/**
 * @SWG\Api(
 *     path="/services/moveresource",
 *     @SWG\Operation(
 *        method="POST",
 *        nickname="MoveResource",
 *        summary="Moves a resource from one resource ID to another",
 *        @SWG\parameters(
 *          @SWG\parameter(name="source", paramType="form", required=true, type="string", description="The Source Resource ID"),
 *          @SWG\parameter(name="destination", paramType="form", required=true, type="string", description="The Target Resource ID"),
 *          @SWG\parameter(name="overwrite", paramType="form", required=false, type="boolean", description="Indicates whether to overwrite the target resource if it exists"),
 *          @SWG\parameter(name="cascade", paramType="form", required=false, type="boolean", description="Indicates whether to cascade any reference changes in related documents as a result of this change")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->post("/services/moveresource", function() use ($app) {
    $ctrl = new MgResourceServiceController($app);
    $ctrl->MoveResource();
});
/**
 * @SWG\Api(
 *     path="/services/transformcoords",
 *     @SWG\Operation(
 *        method="POST",
 *        nickname="TransformCoordinates",
 *        summary="Transforms the given coordinates from the specified source coordinate system to the target coordinate system",
 *        @SWG\parameters(
 *          @SWG\parameter(name="from", paramType="form", required=true, type="string", description="The Source Coordinate System Code"),
 *          @SWG\parameter(name="to", paramType="form", required=true, type="string", description="The Target Coordinate System Code"),
 *          @SWG\parameter(name="coords", paramType="form", required=true, type="string", description="A comma-delimited list of space-delimited coordinate pairs"),
 *          @SWG\parameter(name="format", paramType="form", required=true, type="string", description="xml or json", enum="['xml','json']")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->post("/services/transformcoords", function() use ($app) {
    $ctrl = new MgCoordinateSystemController($app);
    $ctrl->TransformCoordinates();
});
/**
 * @SWG\Api(
 *     path="/services/createmap",
 *     @SWG\Operation(
 *        method="POST",
 *        nickname="CreateRuntimeMap",
 *        summary="Creates a new Runtime Map (MgMap) instance from the specified map definition and returns detailed information about its layer/group structure if requested",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="form", required=false, type="string", description="Your MapGuide Session ID. If none specified you must pass the basic http authentication challenge"),
 *          @SWG\parameter(name="mapdefinition", paramType="form", required=true, type="string", description="The Map Definition ID to create a new runtime map from"),
 *          @SWG\parameter(name="targetmapname", paramType="form", required=false, type="string", description="The target map name to associate the Runtime Map by. By default, the name is generated from the Map Definition ID"),
 *          @SWG\parameter(name="requestedfeatures", paramType="form", required=false, type="integer", description="A bitmask of the information about the Runtime Map that you would like returned. 1=Layer/Group structure, 2=icons, 4=Feature Source Information"),
 *          @SWG\parameter(name="iconformat", paramType="form", required=false, type="string", description="The desired icon image format if icons are requested", enum="['PNG','JPG','PNG8','GIF']"),
 *          @SWG\parameter(name="iconwidth", paramType="form", required=false, type="integer", description="The desired width of generated icons if icons are requested"),
 *          @SWG\parameter(name="iconheight", paramType="form", required=false, type="integer", description="The desired height of generated icons if icons are requested"),
 *          @SWG\parameter(name="iconsperscalerange", paramType="form", required=false, type="integer", description="The number of icons to generate per scale range if icons are requested")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->post("/services/createmap", function() use ($app) {
    $ctrl = new MgMappingServiceController($app);
    $ctrl->CreateRuntimeMap("xml");
});
/**
 * @SWG\Api(
 *     path="/services/createmap.{type}",
 *     @SWG\Operation(
 *        method="POST",
 *        nickname="CreateRuntimeMap",
 *        summary="Creates a new Runtime Map (MgMap) instance from the specified map definition and returns detailed information about its layer/group structure if requested",
 *        @SWG\parameters(
 *          @SWG\parameter(name="session", paramType="form", required=false, type="string", description="Your MapGuide Session ID. If none specified you must pass the basic http authentication challenge"),
 *          @SWG\parameter(name="mapdefinition", paramType="form", required=true, type="string", description="The Map Definition ID to create a new runtime map from"),
 *          @SWG\parameter(name="targetmapname", paramType="form", required=false, type="string", description="The target map name to associate the Runtime Map by. By default, the name is generated from the Map Definition ID"),
 *          @SWG\parameter(name="requestedfeatures", paramType="form", required=false, type="integer", description="A bitmask of the information about the Runtime Map that you would like returned. 1=Layer/Group structure, 2=icons, 4=Feature Source Information"),
 *          @SWG\parameter(name="iconformat", paramType="form", required=false, type="string", description="The desired icon image format if icons are requested", enum="['PNG','JPG','PNG8','GIF']"),
 *          @SWG\parameter(name="iconwidth", paramType="form", required=false, type="integer", description="The desired width of generated icons if icons are requested"),
 *          @SWG\parameter(name="iconheight", paramType="form", required=false, type="integer", description="The desired height of generated icons if icons are requested"),
 *          @SWG\parameter(name="iconsperscalerange", paramType="form", required=false, type="integer", description="The number of icons to generate per scale range if icons are requested"),
 *          @SWG\parameter(name="type", paramType="path", required=true, type="string", description="xml or json", enum="['xml','json']")
 *        ),
 *        @SWG\ResponseMessage(code=400, message="You supplied a bad request due to one or more missing or invalid parameters"),
 *        @SWG\ResponseMessage(code=401, message="Session ID or MapGuide credentials not specified"),
 *        @SWG\ResponseMessage(code=500, message="An error occurred during the operation")
 *     )
 *   )
 */
$app->post("/services/createmap.:format", function($format) use ($app) {
    $ctrl = new MgMappingServiceController($app);
    $ctrl->CreateRuntimeMap($format);
});

?>