
front-end
--login
	|
	|
	----update/delete file
	|
	----view &comment
	|
	----edit team

login:
		whitelist------professor-------view&comment
				   |
				   ----students--------update/delete file
				   				 |
				   				 ------view&comment
		
		visitor------------------------view&comment

			

update/delete file: update or delete ppt/pdf and make some short introduciton

view&comment      : able to view all file updated by students and comment below

edit :assign teamleader to update file & make whitelist


back-end

--login
	|
	|
	----update/delete file
	|
	----view &comment
	|
	----edit team


login: verify if it is in whitelist or visit (with db)
	   record login time

update&delete file:function as title name

view&comment:store all comment and only adminstrastor can delete

edit:create/delete whitelist and see who was logining


