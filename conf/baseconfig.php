<?php 
defined('WEKIT_VERSION') or exit(403);
/**
 * ȫ������
 */
return array(

/**=====���ÿ�ʼ�ڴ�=====**/

'dbcache' => '0',				//�������ݿ����ݻ��棬������mem(��redis)ʱ�����������ʹ��mem(��redis)�������ݿ�����
'distributed' => '0',			//�Ƿ�ʹ�÷ֲ�ʽ�ܹ�������������ʱ������ʹ��֧�ֲַ�ʽ�Ļ������

/*-----ͨ�û��濪��-----*/

'mem.isopen' => 0,				//����memcache���棬��ȷ�����������Ѱ�װ memcache ���񣬲���������Ӧ����
'mem.server' => 'MemCache',		//memcache����������MemCache��MemCached���֣�����ǰphp��չ��װ�����ĸ�
'mem.servers' => array(
	'default' => array(
		array(
			'host' => 'localhost',
			'port' => 11211,
			'pconn' => false,
			'weight' => 1,
			'timeout' => 15,
			'retry' => 15,
			'status' => true,
			'fcallback' => null,
		),
	),
),
'mem.key.prefix' => 'pw',


'redis.isopen' => 0,			//����redis���棬��ȷ�����������Ѱ�װ redis ���񣬲���������Ӧ����
'redis.servers' => array(
	'default' => array(
		array(
			'host' => '10.12.83.10',
			'port' => 6379,
			'pconn' => false,
			'timeout' => 0,
		),
	),
),
'redis.key.prefix' => 'pw',

'apc.isopen' => 0,				//����apc���棬��ȷ�����������Ѱ�װ apc ����
'db.table.name' => 'cache',		//����db���棬ָ������

/**=====���ý����ڴ�=====**/
);