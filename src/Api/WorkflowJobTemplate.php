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

use AwxV2\Entity\JobTemplate as JobTemplateEntity;
use AwxV2\Exception\HttpException;

/**
 *
 *
 */
class WorkflowJobTemplate extends AbstractApi
{
    /**
     * @param int $per_page
     * @param int $page
     *
     * @return JobTemplateEntity[]
     */
    public function getAll($per_page = 200, $page = 1)
    {
        $vars = $this->adapter->get(sprintf('%s/workflow_job_templates/?page_size=%d&page=%d', $this->endpoint, $per_page, $page));

        $vars = json_decode($vars);

        return array_map(function ($var) {
            return new JobTemplateEntity($var);
        }, $vars->results);
    }
    
    /**
     * @param int $id
     *
     * @return JobTemplateEntity
     */
    public function getById($id)
    {
        $var = $this->adapter->get(sprintf('%s/workflow_job_templates/%d/', $this->endpoint, $id));

        $var = json_decode($var);
        
        return new JobTemplateEntity($var);
    }
    
    /**
     * @param int $id
     *
     * @return JobTemplateEntity
     */
    public function launch($id, $body = [])
    {
        $response = $this->adapter->post(sprintf('%s/workflow_job_templates/%d/launch/', $this->endpoint, $id), $body);
        $response = json_decode($response);
        
        return new JobTemplateEntity($response);
    }
}
