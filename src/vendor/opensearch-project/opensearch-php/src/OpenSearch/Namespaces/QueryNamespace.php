<?php

declare(strict_types=1);

/**
 * SPDX-License-Identifier: Apache-2.0
 *
 * The OpenSearch Contributors require contributions made to
 * this file be licensed under the Apache-2.0 license or a
 * compatible open source license.
 *
 * Modifications Copyright OpenSearch Contributors. See
 * GitHub history for details.
 */

namespace OpenSearch\Namespaces;

use OpenSearch\Namespaces\AbstractNamespace;

/**
 * Class QueryNamespace
 *
 * NOTE: This file is autogenerated using util/GenerateEndpoints.php
 */
class QueryNamespace extends AbstractNamespace
{
    /**
     * Deletes specific datasource specified by name.
     *
     * $params['datasource_name'] = (string) The Name of the DataSource to delete.
     * $params['pretty']          = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']           = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace']     = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']          = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path']     = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function datasourceDelete(array $params = [])
    {
        $datasource_name = $this->extractArgument($params, 'datasource_name');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Query\DatasourceDelete');
        $endpoint->setParams($params);
        $endpoint->setDatasourceName($datasource_name);

        return $this->performRequest($endpoint);
    }
    /**
     * Retrieves specific datasource specified by name.
     *
     * $params['datasource_name'] = (string) The Name of the DataSource to retrieve.
     * $params['pretty']          = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']           = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace']     = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']          = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path']     = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function datasourceRetrieve(array $params = [])
    {
        $datasource_name = $this->extractArgument($params, 'datasource_name');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Query\DatasourceRetrieve');
        $endpoint->setParams($params);
        $endpoint->setDatasourceName($datasource_name);

        return $this->performRequest($endpoint);
    }
    /**
     * Creates a new query datasource.
     *
     * $params['pretty']      = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']       = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace'] = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']      = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path'] = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function datasourcesCreate(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Query\DatasourcesCreate');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
    /**
     * Retrieves list of all datasources.
     *
     * $params['pretty']      = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']       = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace'] = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']      = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path'] = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function datasourcesList(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Query\DatasourcesList');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
    /**
     * Updates an existing query datasource.
     *
     * $params['pretty']      = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']       = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace'] = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']      = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path'] = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function datasourcesUpdate(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Query\DatasourcesUpdate');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}
