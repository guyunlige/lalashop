<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ESInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init'; // 使用command  什么命令启动脚本

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'init laravel es for post'; // 描述

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * 实际要做的事情
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        // 创建模版 'scout.elasticsearch.hosts')[0] ==> config\scout.php 的 配置
        $url = config('scout.elasticsearch.hosts')[0] . '/_template/tmp';
        // $client->delete($url); // 一开始没有
        $param = [
            'json' => [
                'template' => config('scout.elasticsearch.index'),
                'mappings' => [
                    '_default_' => [
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    'match_mapping_type' => 'string',
                                    'mapping' => [
                                        'type' => 'text',
                                        'analyzer' => 'ik_smart',
                                        'ignore_above' => 256,
                                        'fields' => [
                                            'keyword' => [
                                                'type' => 'keyword'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $client->put($url, $param);
        $this->info("========创建模板成功=======");

        // 创建 es 索引 *********************************************************************************
        $url = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');
        // $client->delete($url); // 一开始没有
        $param = [
            'json' => [
                'settings' => [
                    'refresh_interval' => '5s',
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    '_default_' => [
                        '_all' => [
                            'enabled' => false
                        ]
                    ]
                ]
            ]
        ];
        $client->put($url, $param);
        $this->info("========创建索引成功=======");

    }
}
