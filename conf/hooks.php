<?php
defined('WEKIT_VERSION') or exit(403);
/**
 * ϵͳhook�����ļ�
 */
return array(
	'c_post_run' => array(
		'description' => '��������չʾҳ',
		'param' => array(),
		'interface' => '',
		'list' => array(
			'poll' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoPollInjector', 
				'method' => 'run', 
				'expression' => 'special.get==poll',
				'description' => 'ͶƱ��չʾ'
			)
		)
	),
	'c_post_doadd' => array(
		'description' => '���������ύҳ',
		'param' => array(),
		'interface' => '',
		'list' => array(
			'poll' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoPollInjector', 
				'method' => 'doadd',
				'expression' => 'special.post==poll',
				'description' => '��ͶƱ��'
			), 
			'att' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoAttInjector', 
				'method' => 'run', 
				'expression' => 'flashatt.post!=0',
				'description' => '����������'
			), 
			'tag' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoTagInjector', 
				'method' => 'doadd',
				'description' => '���ӷ��� - �������'
			),
			'word' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoWordInjector', 
				'method' => 'doadd',
				'description' => '���ӷ��� - ���д�'
			)
		)
	), 
	'c_post_doreply' => array(
		'description' => '����ظ��ύҳ',
		'param' => array(),
		'interface' => '',
		'list' => array(
			'att' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoAttInjector', 
				'method' => 'run', 
				'expression' => 'flashatt.post!=0',
				'description' => '�ظ����� - ����'
			), 
			'dolike_fast_reply' => array(
				'class' => 'SRV:like.srv.fresh.injector.PwLikeDoFreshInjector', 
				'method' => 'run', 
				'expression' => 'isfresh.post==1',
				'description' => '�ظ����� - ϲ��'
			), 
			'dolike_reply_lastpid' => array(
				'class' => 'SRV:like.srv.reply.injector.PwLikeDoReplyInjector', 
				'method' => 'run', 
				'expression' => 'from_type.post==like',
				'description' => '�ظ����� - ���ϲ���Ļظ�'
			),
			'word' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoWordInjector', 
				'method' => 'doadd',
				'description' => '���ӷ��� - ���д�'
			)
		)
	), 
	'c_post_modify' => array(
		'description' => '���ӱ༭ҳ��',
		'param' => array(),
		'interface' => '',
		'list' => array(
			'poll' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoPollInjector', 
				'method' => 'modify', 
				'expression' => 'service:special==poll',
				'description' => '���ӱ༭ - ͶƱ��'
			),
		)
	), 
	'c_post_domodify' => array(
		'description' => '���ӱ༭�ύҳ��',
		'param' => array(),
		'interface' => '',
		'list' => array(
			'poll' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoPollInjector', 
				'method' => 'domodify', 
				'expression' => 'service:special==poll',
				'description' => '���ӱ༭�ύ - ͶƱ��'
			), 
			'att' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoAttInjector', 
				'method' => 'domodify',
				'description' => '���ӱ༭ - ����'
			),
			'tag' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoTagInjector', 
				'method' => 'domodify',
				'description' => '���ӱ༭ - ����'
			),
			'word' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoWordInjector', 
				'method' => 'doadd',
				'description' => '���ӷ��� - ���д�'
			)
		)
	),
	'c_index_run' => array(
		'description' => '�����б�ҳ',
		'param' => array(),
		'interface' => '',
		'list' => array(
		),
	),
	'c_cate_run' => array(
		'description' => '���������б�ҳ',
		'param' => array(),
		'interface' => '',
		'list' => array(
		),
	),
	'c_thread_run' => array(
		'description' => '��������б�ҳ',
		'param' => array(),
		'interface' => '',
		'list' => array(
		),
	),
	'c_read_run' => array(
		'description' => '�����Ķ�ҳ',
		'param' => array(),
		'interface' => '',
		'list' => array(
			'poll' => array(
				'class' => 'SRV:forum.srv.threadDisplay.injector.PwThreadDisplayDoPollInjector', 
				'method' => 'run', 
				'expression' => 'service:thread.info.special==poll',
				'description' => '�����Ķ�ҳ - ͶƱ��'
			),
			'like' => array(
				'class' => 'SRV:like.srv.threadDisplay.injector.PwThreadDisplayDoLikeInjector', 
				'method' => 'run',
				'expression' => 'service:thread.info.like_count!=0',
				'description' => '�����Ķ�ҳ - ϲ��'
			),
			'medal' => array(
				'class' => 'SRV:medal.srv.threadDisplay.injector.PwThreadDisplayDoMedalInjector', 
				'method' => 'run',
				'expression' => 'config:site.medal.isopen==1',
				'description' => '�����Ķ�ҳ - ѫ��'
			),
			'word' => array(
				'class' => 'SRV:forum.srv.threadDisplay.injector.PwThreadDisplayDoWordInjector', 
				'expression' => 'service:thread.info.word_version==0',
				'description' => '�����Ķ�ҳ - �滻���д�'
			),
		)
	),
	'c_register' => array(
		'description' => 'ע��ҳ��',
		'param' => array(),
		'interface' => 'LIB:engine.hook.PwBaseHookInjector',
		'list' => array(
			'invite' => array(
				'class' => 'SRV:user.srv.register.injector.PwRegisterDoInviteInjector',
				'method' => 'run',
				'expression' => 'service:isOpenInvite==1'
			),
			'inviteFriend' => array(
				'class' => 'SRV:user.srv.register.injector.PwRegisterDoInviteFriendInjector',
				'method' => 'run',
			),
			'verifyMobile' => array(
				'class' => 'SRV:user.srv.register.injector.PwRegisterDoVerifyMobileInjector',
				'method' => 'run',
			),
		)
	),
	'c_fresh_post' => array(
		'description' => '��������ҳ�淢������',
		'param' => array(),
		'interface' => '',
		'list' => array(
			'att' => array(
				'class' => 'SRV:forum.srv.post.injector.PwPostDoAttInjector', 
				'method' => 'run', 
				'expression' => 'flashatt.post!=0'
			)
		)
	),
	'c_profile_extends_run' => array (
		'description' => '�û��˵�������չ-չʾ',
		'param' => array(),
		'list' => array(
		),
	),
	'c_profile_extends_dorun' => array (
		'description' => '�û��˵�������չ-ִ��',
		'param' => array(),
		'list' => array(
		),
	),
	'c_login_dorun' => array(
		'description' => '�û���¼�����ֲ�',
		'param' => array(),
		'interface' => '',
		'list' => array(
			'inviteFriend' => array(
				'class' => 'SRV:user.srv.login.injector.PwLoginDoInviteFriendInjector',
				'method' => 'run'
			),
		)
	),
	'm_PwRegisterService' => array(
		'description' => 'ע��Service����',
		'param' => array(),
		'interface' => 'SRV:user.srv.register.do.PwRegisterDoBase',
		'list' => array(
			'bbsinfo' => array(
				'class' => 'SRV:user.srv.register.do.PwRegisterDoUpdateBbsInfo',
				'description' => 'ע����ڣ�����վ����Ϣ'
			),
		)
	),
	'm_PwTopicPost' => array(
		'description' => '��������',
		'param' => array(),
		'interface' => 'SRV:forum.srv.post.do.PwPostDoBase',
		'list' => array(
			'fresh' => array(
				'class' => 'HOOK:PwPost.do.PwPostDoFresh',
				'description' => '������'
			),
			'task' => array(
				'class' => 'SRV:task.srv.condition.PwTaskBbsThreadDo',
				'expression' => 'config:site.task.isOpen==1',
				'description' => '����������'
			),
			'behavior' => array(
				'class' => 'SRV:misc.behavior.do.PwMiscThreadDo',
				'loadway' => 'load',
				'description' => '��¼������Ϊ'
			),
			'medal' => array(
				'class' => 'SRV:medal.srv.condition.do.PwMedalThreadDo',
				'description' => '������ѫ��'
			),
			'remind' => array(
				'class' => 'SRV:forum.srv.post.do.PwPostDoRemind',
			),
			'word' => array(
				'class' => 'SRV:forum.srv.post.do.PwReplyDoWord',
				'description' => '�ظ�-���д�'
			),
		)
	),
	'm_PwReplyPost' => array(
		'description' => '����ظ�',
		'param' => array(),
		'interface' => 'SRV:forum.srv.post.do.PwPostDoBase',
		'list' => array(
			'task' => array(
				'expression' => 'config:site.task.isOpen==1',
				'class' => 'SRV:task.srv.condition.PwTaskBbsPostDo',
				'description' => '���ظ�������'
			),
			'behavior' => array(
				'class' => 'SRV:misc.behavior.do.PwMiscPostDo',
				'loadway' => 'load',
				'description' => '��¼���ظ���Ϊ'
			),
			'medal' => array(
				'class' => 'SRV:medal.srv.condition.do.PwMedalPostDo',
				'description' => '���ظ���ѫ������'
			),
			'remind' => array(
				'class' => 'SRV:forum.srv.post.do.PwReplyDoRemind',
				'description' => '�ظ�-����'
			),
			'notice' => array(
				'class' => 'SRV:forum.srv.post.do.PwReplyDoNotice',
				'description' => '�ظ�-֪ͨ'
			),
			'word' => array(
				'class' => 'SRV:forum.srv.post.do.PwReplyDoWord',
				'description' => '�ظ�-���д�'
			),
		)
	),
	'm_PwThreadList' => array(
		'description' => '�����б�ҳ',
		'param' => array(),
		'interface' => 'SRV:forum.srv.threadList.do.PwThreadListDoBase',
		'list' => array(
			'hits' => array(
				'class' => 'SRV:forum.srv.threadList.do.PwThreadListDoHits',
				'description' => '�����ʵʱ������ʾ',
				'expression' => 'config:bbs.read.hit_update==1',
			)
		),
	),
	'm_PwThreadDisplay' => array(
		'description' => '��������չʾ',
		'param' => array(),
		'interface' => 'SRV:forum.srv.threadDisplay.do.PwThreadDisplayDoBase',
		'list' => array(
			'hits' => array(
				'class' => 'SRV:forum.srv.threadDisplay.do.PwThreadDisplayDoHits',
				'description' => '�����ʵʱ������ʾ',
				'expression' => 'config:bbs.read.hit_update==1',
			)
		)
	),
	/*��ȡ����������*/
	'm_task_gainreward' => array(
		'description' => '��ȡ����',
		'param' => array(),
		'interface' => 'SRV:task.srv.reward.PwTaskRewardDoBase',
		'list' => array(
			'group' => array(
				'class' => 'SRV:task.srv.reward.PwTaskGroupRewardDo',
				'expression' => 'service:type==group',
			),
			'credit' => array(
				'class' => 'SRV:task.srv.reward.PwTaskCreditRewardDo',
				'expression' => 'service:type==credit',
			),
		)
	),
	'm_PwMessageService' => array(
		'description' => '��Ϣ����',
		'param' => array(),
		'interface' => 'SRV:message.srv.do.PwMessageDoBase',
		'list' => array(
			'task' => array(
				'expression' => 'config:site.task.isOpen==1',
				'class' => 'SRV:task.srv.condition.PwTaskMemberMsgDo',
				'loadway' => 'load'
			)
		)
	),
	'm_PwLoginService' => array(
		'description' => '�û���¼֮��Ĳ���',
		'param' => array('@param PwUserBo $userBo ��¼�û��Ķ���', '@param string $ip ��¼��IP'),
		'interface' => 'SRV:user.srv.login.PwUserLoginDoBase',
		'list' => array(
			'autotask' => array(
				'expression' => 'config:site.task.isOpen==1',
				'class' => 'SRV:task.srv.condition.PwAutoTaskLoginDo',
				'loadway' => 'load'
			),
			'userbelong' => array(
				'class' => 'HOOK:PwUser.PwUserLoginDoBelong',
				'loadway' => 'load'
			),
			'behavior' => array(
				'class' => 'SRV:misc.behavior.do.PwMiscUserDo',
				'loadway' => 'load'
			),
			'medal' => array(
				'class' => 'SRV:medal.srv.condition.do.PwMedalUserDo',
				'loadway' => 'load'
			),
			'updateOnline' => array(
				'class' => 'SRV:online.srv.do.PwLoginDoUpdateOnline',
				'loadway' => 'load'
			),
			'autounbancheck' => array(
				'class' => 'SRV:user.srv.login.do.PwLoginDoUnbanCheck',
				'loadway' => 'load'
			),
			/*
			'recommendUser' => array(
				'class' => 'SRV:attention.srv.recommend.PwRecommendUserDo',
				'loadway' => 'load'
			),*/
		)
	),
	'm_PwFreshReplyByWeibo' => array(
		'description' => '΢��',
		'param' => array(),
		'interface' => 'SRV:attention.srv.reply.weibo.PwWeiboDoBase',
		'list' => array(
			'word' => array(
				'class' => 'SRV:attention.srv.reply.weibo.PwWeiboDoWord',
				'description' => '΢��-���д�'
			),
		)
	),
	's_PwThreadsDao_add' => array(
		'description' => '����һ�����Ӽ�¼ʱ������',
		'param' => array('@param int $id ����������tid', '@param array $fields �����ֶ�', '@return void'),
		'interface' => '',
		'list' => array(
			'threadsIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsIndexDao',
				'method' => 'addThread',
				'loadway' => 'loadDao'
			),
			'threadsCateIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsCateIndexDao',
				'method' => 'addThread',
				'loadway' => 'loadDao'
			),
			'threadsDigestIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsDigestIndexDao',
				'method' => 'addThread',
				'loadway' => 'loadDao'
			),
		)
	),
	's_PwThreadsDao_update' => array(
		'description' => '����һ�����Ӽ�¼ʱ������',
		'param' => array('@param int $id ����tid', '@param array $fields ���µ������ֶ�����', '@param array $increaseFields �����������ֶ�����', '@return void'),
		'interface' => '',
		'list' => array(
			'threadsIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsIndexDao',
				'method' => 'updateThread',
				'loadway' => 'loadDao'
			),
			'threadsCateIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsCateIndexDao',
				'method' => 'updateThread',
				'loadway' => 'loadDao'
			),
			'threadsDigestIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsDigestIndexDao',
				'method' => 'updateThread',
				'loadway' => 'loadDao'
			),
		)
	),
	's_PwThreadsDao_batchUpdate' => array(
		'description' => '�������¶������Ӽ�¼ʱ������',
		'param' => array('@param array $ids ����tid����', '@param array $fields ���µ������ֶ�����', '@param array $increaseFields �����������ֶ�����', '@return void'),
		'interface' => '',
		'list' => array(
			'threadsIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsIndexDao',
				'method' => 'batchUpdateThread',
				'loadway' => 'loadDao'
			),
			'threadsCateIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsCateIndexDao',
				'method' => 'batchUpdateThread',
				'loadway' => 'loadDao'
			),
			'threadsDigestIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsDigestIndexDao',
				'method' => 'batchUpdateThread',
				'loadway' => 'loadDao'
			),
		)
	),
	's_PwThreadsDao_revertTopic' => array(
		'description' => '��ԭ����ʱ������',
		'param' => array('@param array $tids ����tid����', '@return void'),
		'interface' => '',
		'list' => array(
			'threadsIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsIndexDao',
				'method' => 'revertTopic',
				'loadway' => 'loadDao'
			),
			'threadsCateIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsCateIndexDao',
				'method' => 'revertTopic',
				'loadway' => 'loadDao'
			),
			'threadsDigestIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsDigestIndexDao',
				'method' => 'revertTopic',
				'loadway' => 'loadDao'
			),
		)
	),
	's_PwThreadsDao_delete' => array(
		'description' => 'ɾ��һ������ʱ������',
		'param' => array('@param int $id ����tid', '@return void'),
		'interface' => '',
		'list' => array(
			'threadsIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsIndexDao',
				'method' => 'deleteThread',
				'loadway' => 'loadDao'
			),
			'threadsCateIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsCateIndexDao',
				'method' => 'deleteThread',
				'loadway' => 'loadDao'
			),
			'threadsDigestIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsDigestIndexDao',
				'method' => 'deleteThread',
				'loadway' => 'loadDao'
			),
		)
	),
	's_PwThreadsDao_batchDelete' => array(
		'description' => '����ɾ���������ʱ������',
		'param' => array('@param array $ids ����tid����', '@return void'),
		'interface' => '',
		'list' => array(
			'threadsIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsIndexDao',
				'method' => 'batchDeleteThread',
				'loadway' => 'loadDao'
			),
			'threadsCateIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsCateIndexDao',
				'method' => 'batchDeleteThread',
				'loadway' => 'loadDao'
			),
			'threadsDigestIndex' => array(
				'class' => 'SRV:forum.dao.PwThreadsDigestIndexDao',
				'method' => 'batchDeleteThread',
				'loadway' => 'loadDao'
			),
		)
	),
	's_addFollow' => array(
		'description' => '��������ע����ʱ������',
		'param' => array('@param int $uid �û�', '@param int $touid ����ע�û�', '@return void'),
		'interface' => '',
		'list' => array(
			'medal' => array(
				'class' => 'SRV:medal.srv.condition.do.PwMedalFansDo',
				'method' => 'addFollow',
				'loadway' => 'load'
			),
			'task' => array(
				'expression' => 'config:site.task.isOpen==1',
				'class' => 'SRV:task.srv.condition.PwTaskMemberFansDo',
				'method' => 'addFollow',
				'loadway' => 'load',
			),
			'message' => array(
				'class' => 'SRV:message.srv.do.PwNoticeFansDo',
				'method' => 'addFollow',
				'loadway' => 'load',
			),
		)
	),
	's_deleteFollow' => array(
		'description' => '������ȡ����ע����ʱ������',
		'param' => array('@param int $uid �û�', '@param int $touid ����ע�û�', '@return void'),
		'interface' => '',
		'list' => array(
			'medal' => array(
				'class' => 'SRV:medal.srv.condition.do.PwMedalFansDo',
				'method' => 'delFollow',
				'loadway' => 'load'
			),
			/*
			'recommend' => array(
				'class' => 'SRV:attention.srv.recommend.PwRecommendAttentionDo',
				'method' => 'delFollow',
				'loadway' => 'load'
			),*/
		)
	),
	
	's_PwTaskDao_update' => array(
		'description' => '����һ�������¼ʱ������',
		'param' => array('@param int $id ����tid', '@param array $fields ���µ������ֶ�����', '@param array $increaseFields �����������ֶ�����', '@return void'),
		'interface' => '',
		'list' => array(
			'TaskUser' => array(
				'class' => 'SRV:task.dao.PwTaskUserDao',
				'method' => 'updateIsPeriod',
				'loadway' => 'loadDao'
			)
		)
	),
	's_profile_editUser' => array(
		'description' => '�����û�����ʱ������',
		'param' => array('@param PwUserInfoDm $dm', '@return void'),
		'interface' => '',
		'list' => array(
			'task' => array(
				'expression' => 'config:site.task.isOpen==1',
				'class' => 'SRV:task.srv.condition.PwTaskProfileConditionDo',
				'loadway' => 'load',
				'method' => 'editUser',
			),
		)
	),
	's_update_avatar' => array(
		'description' => '�����û�ͷ��ʱ������',
		'param' => array('@param int $uid �û�id', '@return void'),
		'interface' => '',
		'list' => array(
			'task' => array(
				'expression' => 'config:site.task.isOpen==1',
				'class' => 'SRV:task.srv.condition.PwTaskMemberAvatarDo',
				'loadway' => 'load',
				'method' => 'uploadAvatar',
			),
		)
	),
	's_PwUser_delete' => array(
		'description' => 'ɾ���û�ʱ������',
		'param' => array('@param int $uid �û�id', '@return void'),
		'interface' => '',
		'list' => array(
			'ban' => array(
				'class' => 'SRC:hooks.PwUser.PwUserDoBan',
				'method' => 'deleteBan',
				'loadway' => 'load'
			),
			'belong' => array(
				'class' => 'SRC:hooks.PwUser.PwUserDoBelong',
				'method' => 'deleteUser',
				'loadway' => 'load'
			),
			'registerCheck' => array(
				'class' => 'SRC:hooks.PwUser.PwUserDoRegisterCheck',
				'method' => 'deleteUser',
				'loadway' => 'load',
			),
			'activeCode' => array(
				'class' => 'SRV:user.PwUserActiveCode',
				'method' => 'deleteInfoByUid',
				'loadway' => 'load',
			),
			'task' => array(
				'class' => 'SRV:task.PwTaskUser',
				'method' => 'deleteByUid',
				'loadway' => 'load',
			),
			'usertag' => array(
				'class' => 'SRV:usertag.PwUserTagRelation',
				'method' => 'deleteRelationByUid',
				'loadway' => 'load',
			),
			'mobile' => array(
				'class' => 'SRV:user.PwUserMobile',
				'method' => 'deleteByUid',
				'loadway' => 'load',
			),
		)
	),
	's_PwUser_batchDelete' => array(
		'description' => '����ɾ���û�ʱ������',
		'param' => array('@param array $uids �û�id����', '@return void'),
		'interface' => '',
		'list' => array(
			'ban' => array(
				'class' => 'SRC:hooks.PwUser.PwUserDoBan',
				'method' => 'batchDeleteBan',
				'loadway' => 'load'
			),
			'belong' => array(
				'class' => 'SRC:hooks.PwUser.PwUserDoBelong',
				'method' => 'batchDeleteUser',
				'loadway' => 'load'
			),
			'registerCheck' => array(
				'class' => 'SRC:hooks.PwUser.PwUserDoRegisterCheck',
				'method' => 'batchDeleteUser',
				'loadway' => 'load',
			),
			'task' => array(
				'class' => 'SRV:task.PwTaskUser',
				'method' => 'batchDeleteByUid',
				'loadway' => 'load',
			),
			'usertag' => array(
				'class' => 'SRV:usertag.PwUserTagRelation',
				'method' => 'batchDeleteRelationByUids',
				'loadway' => 'load',
			),
		)
	),
	's_PwUser_add' => array(
		'description' => '����û�ʱ������',
		'param' => array('@param PwUserInfoDm $dm', '@return void'),
		'interface' => '',
		'list' => array(
			'belong' => array(
				'class' => 'SRC:hooks.PwUser.PwUserDoBelong',
				'method' => 'editUser',
				'loadway' => 'load'
			),
		)
	),
	's_PwUser_update' => array(
		'description' => '�����û���Ϣʱ������',
		'param' => array('@param PwUserInfoDm $dm', '@return void'),
		'interface' => '',
		'list' => array(
			'belong' => array(
				'class' => 'SRC:hooks.PwUser.PwUserDoBelong',
				'method' => 'editUser',
				'loadway' => 'load'
			),
		)
	),
	's_PwUserDataDao_update' => array(
		'description' => '�û����ݸ���ʱ������',
		'param' => array('@param int $id �û�id', '@param array $fields ���µ��û��ֶ�����', '@param array $increaseFields �������û��ֶ�����', '@return void'),
		'interface' => '',
		'list' => array(
			'level' => array(
				'class' => 'SRV:usergroup.srv.PwUserGroupsService',
				'method' => 'updateLevel',
				'loadway' => 'load'
			),
			'autoBan' => array(
				'class' => 'SRV:user.srv.PwUserBanService',
				'method' => 'autoBan',
				'loadway' => 'load',
				'expression' => 'config:site.autoForbidden.open==1',
			),
		)
	),
	's_PwUserGroups_update' => array(
		'description' => '�û������ϸ���ʱ������',
		'param' => array('@param int $gid �û���id', '@return void'),
		'interface' => '',
		'list' => array(
			'usergroup' => array(
				'class' => 'SRV:usergroup.srv.PwUserGroupsService',
				'method' => 'updateGroupCacheByHook',
				'loadway' => 'load'
			),
		)
	),
	's_PwUserGroupsDao_delete' => array(
		'description' => 'ɾ���û���ʱ������',
		'param' => array('@param int $gid �û���id', '@return void'),
		'interface' => '',
		'list' => array(
			'usergroup' => array(
				'class' => 'SRV:usergroup.srv.PwUserGroupsService',
				'method' => 'deleteGroupCacheByHook',
				'loadway' => 'load'
			),
		)
	),
	's_PwUserGroupPermission_update' => array(
		'description' => '�û���Ȩ�ޱ��ʱ������',
		'param' => array('@param PwUserPermissionDm $dm', '@return void'),
		'interface' => '',
		'list' => array(
			'usergroup_permission' => array(
				'class' => 'SRV:usergroup.srv.PwUserGroupsService',
				'method' => 'updatePermissionCacheByHook',
				'loadway' => 'load'
			),
		)
	),
	's_PwLikeService_delLike' => array( 
		'description' => 'ɾ��ϲ��',
		'list' => array(
			'behavior' => array(
				'class' => 'SRV:misc.behavior.do.PwMiscLikeDo',
				'method' => 'delLike',
				'loadway' => 'load'
			),
			'medal' => array(
				'class' => 'SRV:medal.srv.condition.do.PwMedalLikeDo',
				'method' => 'delLike',
				'loadway' => 'load'
			),
		)
	),
	's_PwLikeService_addLike' => array( 
		'description' => '���ϲ��',
		'list' => array(
			'task' => array(
				'expression' => 'config:site.task.isOpen==1',
				'class' => 'SRV:task.srv.condition.PwTaskBbsLikeDo',
				'method' => 'addLike',
				'loadway' => 'load'
			),
			'behavior' => array(
				'class' => 'SRV:misc.behavior.do.PwMiscLikeDo',
				'method' => 'addLike',
				'loadway' => 'load'
			),
			'medal' => array(
				'class' => 'SRV:medal.srv.condition.do.PwMedalLikeDo',
				'method' => 'addLike',
				'loadway' => 'load'
			)
		)
	),
	's_PwUserTagRelationDao_deleteRelation' => array(
		'description' => 'ɾ���û���ǩ�Ĺ�ϵ������',
		'param' => array('@param int $tag_id ��ǩid', '@return void'),
		'interface' => '',
		'list' => array(
			'PwUserTag' => array(
				'class' => 'SRV:usertag.dao.PwUserTagDao',
				'method' => 'updateTag',
				'loadway' => 'loadDao'
			),
		)
	),
	's_PwUserTagDao_deleteTag' => array(
		'description' => 'ɾ���û���ǩʱ������',
		'param' => array('@param int $tag_id ��ǩid', '@return void'),
		'interface' => '',
		'list' => array(
			'PwUserTagRelation' => array(
				'class' => 'SRV:usertag.dao.PwUserTagRelationDao',
				'method' => 'deleteRelationByTagid',
				'loadway' => 'loadDao'
			),
		)
	),
	's_PwUserTagDao_batchDeleteTag' => array(
		'description' => '����ɾ���û���ǩʱ������',
		'param' => array('@param array $tag_ids ��ǩid����', '@return void'),
		'interface' => '',
		'list' => array(
			'PwUserTagRelation' => array(
				'class' => 'SRV:usertag.dao.PwUserTagRelationDao',
				'method' => 'batchDeleteRelationByTagids',
				'loadway' => 'loadDao'
			),
		)
	),
	's_PwUserTagRelation_batchDeleteRelation' => array(
		'description' => 'ɾ���û���ǩ��ϵ��ʱ��',
		'param' => array('@param array $tag_ids ', '@param PwUserTagRelation ', '@return void'),
		'interface' => '',
		'list' => array(
			'PwDeleteRelationDoUpdateTag' => array(
				'class' => 'SRV:usertag.srv.do.PwDeleteRelationDoUpdateTag',
				'method' => 'batchDeleteRelation',
				'loadway' => 'load'
			),
		)
	),
	's_PwUserTagRelation_deleteRelationByUid' => array(
		'description' => '�����û�IDɾ���û���ǩ��ϵ',
		'param' => array('@param int $uid ', '@return void'),
		'interface' => '',
		'list' => array(
			'PwDeleteRelationDoUpdateTag' => array(
				'class' => 'SRV:usertag.srv.do.PwDeleteRelationDoUpdateTag',
				'method' => 'deleteRelationByUid',
				'loadway' => 'load'
			),
		)
	),
	's_PwUserTagRelation_batchDeleteRelationByUids' => array(
		'description' => '�����û�ID�б�����ɾ���û���ǩ��ϵ',
		'param' => array('@param array $uid ', '@return void'),
		'interface' => '',
		'list' => array(
			'PwDeleteRelationDoUpdateTag' => array(
				'class' => 'SRV:usertag.srv.do.PwDeleteRelationDoUpdateTag',
				'method' => 'batchDeleteRelationByUids',
				'loadway' => 'load'
			),
		)
	),
	/*��ӱ���*/
	's_PwEmotionDao_add' => array(
		'description' => '��ӱ���ʱ������',
		'param' => array('@param int $id id', '@param array $fields �ֶ���Ϣ', '@return void'),
		'interface' => '',
		'list' => array(
			'addEmotion' => array(
				'class' => 'SRV:emotion.srv.PwEmotionService',
				'method' => 'updateCache',
				'loadway' => 'load'
			),
		)
	),
	/*�༭����*/
	's_PwEmotionDao_update' => array(
		'description' => '�༭����ʱ������',
		'param' => array('@param int $id ����id', '@param array $fields �ֶ���Ϣ', '@param array $increaseFields �ֶ���Ϣ', '@return void'),
		'interface' => '',
		'list' => array(
			'addEmotion' => array(
				'class' => 'SRV:emotion.srv.PwEmotionService',
				'method' => 'updateCache',
				'loadway' => 'load'
			),
		)
	),
	/*ɾ������*/
	's_PwEmotionDao_delete' => array(
		'description' => 'ɾ������ʱ������',
		'param' => array('@param int $id ����id', '@return void'),
		'interface' => '',
		'list' => array(
			'addEmotion' => array(
				'class' => 'SRV:emotion.srv.PwEmotionService',
				'method' => 'updateCache',
				'loadway' => 'load'
			),
		)
	),
	's_PwEmotionDao_deleteEmotionByCatid' => array(
		'description' => 'ɾ��һ�����ʱ������',
		'param' => array('@param int $cateId ������id', '@return void'),
		'interface' => '',
		'list' => array(
			'addEmotion' => array(
				'class' => 'SRV:emotion.srv.PwEmotionService',
				'method' => 'updateCache',
				'loadway' => 'load'
			),
		)
	),
	's_PwConfigDao_update' => array(
		'description' => 'ȫ�����ø���ʱ������',
		'param' => array('@param string $namespace ������'),
		'interface' => '',
		'list' => array(
			'configCache' => array(
				'class' => 'SRV:config.srv.PwConfigService',
				'method' => 'updateConfig',
				'loadway' => 'load'
			),
		)
	),
	's_PwThreadType' => array(
		'description' => '��ȡ������չ����ʱ������',
		'param' => array('@param array $tType ��������', '@return array'),
		'interface' => '',
		'list' => array(
			/*
			'debate' => array(
				'class' => 'HOOK:PwThreadType.PwThreadTypeDoDebate',
				'method' => 'getTtype',
				'loadway' => 'load'
			)*/
		)
	),
	's_punch' => array(
		'description' => '��ʱ������',
		'param' => array('@param PwUserInfoDm $dm', '@return void'),
		'interface' => '',
		'list' => array(
			'task' => array(
				'expression' => 'config:site.task.isOpen==1',
				'class' => 'SRV:task.srv.condition.PwTaskMemberPunchDo',
				'method' => 'doPunch',
				'loadway' => 'load'
			)
		)
	),
	/*��չ�洢����*/
	's_PwStorage_getStorages' => array( //todo
		'description' => '��ȡ�����洢����',
		'param' => array('@param array $storages', '@return array'),
		'interface' => '',
		'list' => array(
		)
	),
	's_PwThreadManageDoCopy' => array( //todo
		'description' => '���Ӹ���',
		'param' => array('@param PwThreadManage $srv', '@return void'),
		'interface' => 'PwThreadManageCopyDoBase',
		'list' => array(
			'poll' => array(
				'class' => 'SRV:forum.srv.manage.do.PwThreadManageCopyDoPoll', 
				'method' => 'copyThread',
				'loadway' => 'load',
				'expression' => 'service:special==poll',
			), 
			'att' => array(
				'class' => 'SRV:forum.srv.manage.do.PwThreadManageCopyDoAtt', 
				'method' => 'copyThread',
				'loadway' => 'load',
				'expression' => 'service:ifupload!=0',
			),
		)
	),
	/* �û��˳�֮ǰ�ĸ��� */
	's_PwUserService_logout' => array(
		'description' => '�˳���¼',
		'param' => array('@param PwUserBo $loginUser', '@return void'),
		'interface' => 'PwLogoutDoBase',
		'list' => array(
			'updatelastvist' => array(
				'class' => 'SRV:user.srv.logout.do.PwLogoutDoUpdateLastvisit',
				'method' => 'beforeLogout',
				'loadway' => 'load'
			),
			'updateOnline' => array(
				'class' => 'SRV:online.srv.do.PwLogoutDoUpdateOnline',
				'method' => 'beforeLogout',
				'loadway' => 'load'
			),
		),
	),
	's_PwEditor_app' => array(
		'description' => '�༭��������չ',
		'param' => array('@param array $var', '@return array'),
		'list' => array(
		)
	),
	's_PwCreditOperationConfig' => array(
		'description' => '���ֲ�������',
		'param' => array('@param array $config ���ֲ�������', '@return array'),
		'list' => array(
		)
	),
	's_seo_config' => array(
		'description' => 'seo�Ż���չ',
		'param' => array('@param array $config seo��չ����', '@return array'),
		'list' => array(
		)
	),
	's_PwUserBehaviorDao_replaceInfo' => array(
		'description' => '�û���Ϊ������չ',
		'param' => array('@param array $data �û���Ϊ����', '@return '),
		'list' => array(
			'task' => array(
				'class' => 'SRV:task.srv.PwTaskService',
				'method' => 'sendAutoTask',
				'loadway' => 'load',
				'expression' => 'config:site.task.isOpen==1',
			),
		),
	),
	's_admin_menu' => array(
		'description' => '��̨�˵���չ',
		'param' => array('@param array $config ��̨�˵�����', '@return array'),
		'list' => array(
		)
	),
	's_permissionCategoryConfig' => array(
		'description' => '�û����Ȩ��',
		'param' => array('@param array $config �û����Ȩ��', '@return array'),
		'list' => array(
		)
	),
	's_permissionConfig' => array(
		'description' => '�û���Ȩ��',
		'param' => array('@param array $config �û���Ȩ��', '@return array'),
		'list' => array(
		)
	),
	's_PwMobileService_checkVerify' => array( 
		'description' => '��֤�ֻ����',
		'param' => array('@param int $mobile'),
		'list' => array(
		)
	),
	's_header_nav' => array(
		'description' => 'ȫ��ͷ������',
		'param' => array(),
		'list' => array(
		)
	),
	's_header_info_1' => array(
		'description' => 'ͷ���û���Ϣ��չ��1',
		'param' => array(),
		'list' => array(
		)
	),
	's_header_info_2' => array(
		'description' => 'ͷ���û���Ϣ��չ��2',
		'param' => array(),
		'list' => array(
		)
	),
	's_header_my' => array(
		'description' => 'ͷ���ʺŵ�����',
		'param' => array(),
		'list' => array(
		)
	),
	's_footer' => array(
		'description' => 'ȫ�ֵײ�',
		'param' => array(),
		'list' => array(
		)
	),
	's_space_nav' => array(
		'description' => '���˿ռ䵼����չ',
		'param' => array('@param array $space', '@param string $src'),
		'list' => array(
		)
	),
	's_space_profile' => array(
		'description' => '�ռ�����ҳ��',
		'param' => array('@param array $space'),
		'interface' => '',
		'list' => array( //���˳���ģ�pdҪ���
			'education' => array(
				'class' => 'SRV:education.srv.profile.do.PwSpaceProfileDoEducation', 
				'method' => 'createHtml'
			),
			'work' => array(
				'class' => 'SRV:work.srv.profile.do.PwSpaceProfileDoWork', 
				'method' => 'createHtml'
			),
		)
	),
	's_profile_menus' => array (
		'description' => '��������-�˵�����չ',
		'param' => array('@param array $config ע��Ĳ˵�', '@return array'),
		'list' => array(
		),
	),

	's_attachment_watermark' => array(
		'description' => 'ȫ��->ˮӡ����->ˮӡ������չ',
		'param' => array('@param array $config ���е���Ҫ���õĲ���,ÿһ����չ���ʽ:key=>title', '@return array'),
		'list' => array(
		),
	),
	's_verify_showverify' => array(
		'description' => 'ȫ��->��֤��->��֤����',
		'param' => array('@param array $config ��Ҫ���õĲ���,ÿһ����չ���ʽ:key=>title', '@return array'),
		'list' => array(
		),
	),
	/*�ֻ�������չ*/
	's_PwMobileService_getPlats' => array(
		'description' => '�ֻ����� - ƽ̨ѡ��',
		'param' => array('@param array $config �����ļ����ɲο�SRV:mobile.config.plat.php', '@return array'),
		'list' => array(
		),
	),
);