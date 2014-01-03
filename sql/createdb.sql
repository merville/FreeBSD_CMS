create database freebsdcms;
grant usage on *.* to bsduser@localhost identified by 'cmsdbpassword';
grant all privileges on freebsdcms.* to bsduser@localhost ;
