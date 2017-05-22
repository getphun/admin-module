DELETE FROM `user_perms_chain` WHERE `user_perms` IN (
    SELECT `id` FROM `user_perms` WHERE `group` = 'Modules'
);

DELETE FROM `user_perms` WHERE `group` = 'Modules';