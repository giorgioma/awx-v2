<?php

/*
 * This file is part of the AwxV2 library.
 *
 * (c) Sdwru https://github.com/sdwru
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AwxV2\Api;

use AwxV2\Entity\Job as JobEntity;
use AwxV2\Exception\HttpException;

/**
 *
 *
 */
class WorkflowJob extends AbstractApi
{
    /**
     * @param int $per_page
     * @param int $page
     *
     * @return DomainEntity[]
     */
    public function getAll($per_page = 200, $page = 1)
    {
        $vars = $this->adapter->get(sprintf('%s/workflow_jobs/?page_size=%d&page=%d', $this->endpoint, $per_page, $page));

        $vars = json_decode($vars);

        return array_map(function ($var) {
            return new JobEntity($var);
        }, $vars->results);
    }

    /**
     * @param int $id
     *
     * @throws HttpException
     *
     * @return JobEntity
     */
    public function getById($id)
    {
        $var = $this->adapter->get(sprintf('%s/workflow_jobs/%s/', $this->endpoint, $id));

        $var = json_decode($var);

        return new JobEntity($var);
    }

    /**
     * @param string $domain
     *
     * @throws HttpException
     */
    public function delete($var)
    {
        $this->adapter->delete(sprintf('%s/workflow_jobs/%s', $this->endpoint, $var));
    }
}
