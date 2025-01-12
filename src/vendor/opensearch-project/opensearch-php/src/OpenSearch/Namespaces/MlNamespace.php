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
 * Class MlNamespace
 *
 * NOTE: This file is autogenerated using util/GenerateEndpoints.php
 */
class MlNamespace extends AbstractNamespace
{
    /**
     * Deletes a model.
     *
     * $params['id']          = (string)
     * $params['pretty']      = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']       = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace'] = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']      = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path'] = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteModel(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\DeleteModel');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }
    /**
     * Deletes a model group.
     *
     * $params['id']          = (string)
     * $params['pretty']      = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']       = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace'] = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']      = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path'] = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteModelGroup(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\DeleteModelGroup');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }
    /**
     * Retrieves a model group.
     *
     * $params['model_group_id'] = (string)
     * $params['pretty']         = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']          = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace']    = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']         = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path']    = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getModelGroup(array $params = [])
    {
        $model_group_id = $this->extractArgument($params, 'model_group_id');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\GetModelGroup');
        $endpoint->setParams($params);
        $endpoint->setModelGroupId($model_group_id);

        return $this->performRequest($endpoint);
    }
    /**
     * Retrieves a task.
     *
     * $params['id']          = (string)
     * $params['pretty']      = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']       = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace'] = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']      = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path'] = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getTask(array $params = [])
    {
        $id = $this->extractArgument($params, 'id');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\GetTask');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }
    /**
     * Registers a model.
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
    public function registerModel(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\RegisterModel');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
    /**
     * Registers a model group.
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
    public function registerModelGroup(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\RegisterModelGroup');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
    /**
     * Searches for models.
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
    public function searchModels(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\SearchModels');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
    /**
     * $params['body']             = (string) The body of the request (Required)
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function createConnector(array $params = []): array
    {
        $body = $this->extractArgument($params, 'body');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\CreateConnector');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
    /**
     * $params['id']             = (string) The id of the connector (Required)
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function deleteConnector(array $params = []): array
    {
        $id = $this->extractArgument($params, 'id');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\DeleteConnector');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }
    /**
     * $params['id']             = (string) The id of the model (Required)
     * $params['body']           = (string) The body of the request
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function deployModel(array $params = []): array
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\DeployModel');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        if ($body) {
            $endpoint->setBody($body);
        }

        return $this->performRequest($endpoint);
    }
    /**
     * $params['id']             = (string) The id of the connector (Required)
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function getConnector(array $params = []): array
    {
        $id = $this->extractArgument($params, 'id');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\GetConnector');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }
    /**
     * $params['body']             = (string) The body of the request
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function getConnectors(array $params = []): array
    {
        if (!isset($params['body'])) {
            $params['body'] = [
              'query' => [
                'match_all' => new \StdClass(),
              ],
              'size' => 1000,
            ];
        }
        $body = $this->extractArgument($params, 'body');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\GetConnectors');
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
    /**
     * $params['body']             = (string) The body of the request
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function getModelGroups(array $params = []): array
    {
        if (!isset($params['body'])) {
            $params['body'] = [
              'query' => [
                'match_all' => new \StdClass(),
              ],
              'size' => 1000,
            ];
        }
        $body = $this->extractArgument($params, 'body');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\GetModelGroups');
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
    /**
     * $params['id']             = (string) The id of the model (Required)
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function getModel(array $params = []): array
    {
        $id = $this->extractArgument($params, 'id');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\GetModel');
        $endpoint->setParams($params);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }
    /**
     * Proxy function to getModels() to prevent BC break.
     * This API will be removed in a future version. Use 'searchModels' API instead.
     */
    public function getModels(array $params = [])
    {
        if (!isset($params['body'])) {
            $params['body'] = [
                'query' => [
                    'match_all' => new \StdClass(),
                ],
                'size' => 1000,
            ];
        }

        return $this->searchModels($params);
    }
    /**
     * $params['id']             = (string) The id of the model (Required)
     * $params['body']           = (string) The body of the request
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function predict(array $params = []): array
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\Predict');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
    /**
     * $params['id']             = (string) The id of the model (Required)
     * $params['body']           = (string) The body of the request
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function undeployModel(array $params = []): array
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\UndeployModel');
        $endpoint->setParams($params);
        $endpoint->setId($id);
        if ($body) {
            $endpoint->setBody($body);
        }

        return $this->performRequest($endpoint);
    }
    /**
     * $params['id']             = (string) The id of the model group (Required)
     * $params['body']           = (array) The body of the request (Required)
     *
     * @param array $params Associative array of parameters
     *
     * @return array
     *   The response.
     */
    public function updateModelGroup(array $params = []): array
    {
        $id = $this->extractArgument($params, 'id');
        $body = $this->extractArgument($params, 'body');
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Ml\UpdateModelGroup');
        $endpoint->setParams($params);
        $endpoint->setBody($body);
        $endpoint->setId($id);

        return $this->performRequest($endpoint);
    }
}
