use `food`;
drop procedure if exists `cook_menu_all`;
drop procedure if exists `current_menu`;
drop procedure if exists `cook_kitchens`;
drop procedure if exists `product_filters`;
drop procedure if exists `search_dish`;
drop procedure if exists `search_cook`;
delimiter ;;

create procedure `cook_menu_all`(in param_user_id int(11))
begin
	select *
	from product p 
	left join dish d
		on d.product_id = p.id
	left join `set` s
		on s.product_id = p.id
	left join `set_dish` sd
		on sd.set_id = s.product_id
	left join `dish` dd
		on dd.product_id = sd.dish_id
	left join `dish_kitchen` dk
		on dk.dish_id = d.product_id
	left join `dish_kitchen` dks
		on dks.dish_id = dd.product_id
	where p.user_id = param_user_id
	group by p.id;
end;;

create procedure `current_menu`(in param_sid varchar(80))
begin
	(
	select
		`c`.`id`,
		`c`.`pid`,
		`c`.`sid`,
		`c`.`header`,
		`c`.`order`
	from
		`page` `p`
	left join
		`page` `r` on `r`.`id` = `p`.`pid`
	left join
		`page` `c` on if(`r`.`id`, `c`.`pid` = `r`.`id`, `c`.`pid` is null)
	where
		`p`.`sid` = param_sid
	)
	union all
	(
	select
		`c2`.`id`,
		`c2`.`pid`,
		`c2`.`sid`,
		`c2`.`header`,
		`c2`.`order`
	from
		`page` `p`
	left join
		`page` `r` on `r`.`id` = `p`.`pid`
	left join
		`page` `c` on if(`r`.`id`, `c`.`pid` = `r`.`id`, `c`.`pid` is null)
	inner join
		`page` `c2` on `c2`.`pid` = `c`.`id`
	where
		`p`.`sid` = param_sid
	)
	order by
		`order` asc,
		`id` asc;
end ;;

create procedure `cook_kitchens`(in param_user_id int(11))
begin
select
		distinct k.kitchen_id as id,
		kh.header as header
	from food.product p
	left join dish d on d.product_id = p.id
	left join dish_kitchen k on k.dish_id = d.product_id
	left join kitchen kh on kh.id = k.kitchen_id
	where p.user_id = param_user_id;
end;;

create procedure `product_filters`()
begin
	select
		min(`p`.`pricesale`) as `price_min`,
		max(`p`.`price`) as `price_max`
	from
		`product` `p`;
end;;

-- create procedure `search_dish`(
-- 	in param_offset int,
-- 	in param_rows int,
-- 	in param_dishordiet varchar(255),
-- 	in param_from decimal(8,2),
-- 	in param_to decimal(8,2),
-- 	in param_dishtype int,
-- 	in param_kitchen varchar(180),
-- 	in param_q varchar(32),
-- 	in param_pickup int,
-- 	in param_workhome int,
-- 	in param_costdeliveryfrom decimal(8,2),
-- 	in param_costdeliveryto decimal(8,2)
-- )
-- begin
-- 	select SQL_CALC_FOUND_ROWS
-- 		`p`.`id`
-- 	from
-- 		`product` `p`
-- 		left join `dish` `d` on `d`.`product_id` = `p`.`id`
-- 		left join `diet` `di` on `di`.`id` = `d`.`diet_id`
-- 		left join `dish_kitchen` `dk` on `dk`.`dish_id` = `d`.`product_id`
-- 		left join `kitchen` `k` on `k`.`id` = `dk`.`kitchen_id`
-- 		left join `user` `u` on `u`.`id` = `p`.`user_id`
-- 		left join `profile_cook` `pc` on `pc`.`user_id` = `u`.`id`
-- 	where
-- 		case
-- 			when param_dishordiet = 'dish' then `d`.`diet_id` is null
-- 			when param_dishordiet = 'diet' then `d`.`diet_id` is not null
-- 			else 1 end
-- 		and `p`.`price` >= param_from
-- 		and `p`.`price` <= param_to
-- 		and ifnull(`d`.`dishtype_id` = param_dishtype, 1)
-- 		and
-- 			case
-- 				when param_dishordiet = 'dish' then ifnull(`k`.`sid` = param_kitchen, 1)
-- 				when param_dishordiet = 'diet' then ifnull(`di`.`sid` = param_kitchen, 1)
-- 			end
-- 		and if(param_q=param_q, `p`.`header` like concat('%',param_q,'%'), 1)
-- 		and ifnull(`pc`.`pickup` = param_pickup, 1)
-- 		and if(param_workhome is not null, `pc`.`workhome` = 1, 1)
-- 		and ifnull(`pc`.`costdelivery` >= param_costdeliveryfrom, 1)
-- 		and ifnull(`pc`.`costdelivery` <= param_costdeliveryto, 1)
-- 		and if(param_costdeliveryfrom is not null or param_costdeliveryto is not null, `pc`.`costdelivery` is not null, 1)
-- 		and `u`.`usertype` = 'cook'
-- 		and `u`.`role` = 10
-- 		and `u`.`status` = 10
-- 	group by `p`.`id`
-- 	limit param_offset, param_rows;
-- end;;

create procedure `search_dish`(
	in param_offset int,
	in param_rows int,
	in param_dishordiet varchar(255),
	in param_from decimal(8,2),
	in param_to decimal(8,2),
	in param_dishtype varchar(255),
	in param_kitchen varchar(255),
	in param_q varchar(32),
	in param_pickup int,
	in param_workhome int,
	in param_costdeliveryfrom decimal(8,2),
	in param_costdeliveryto decimal(8,2)
)
begin
	select SQL_CALC_FOUND_ROWS
		`p`.`id`
	from
		`product` `p`
		left join `dish` `d` on `d`.`product_id` = `p`.`id`
		left join `dishtype` `dt` on `dt`.`id` = `d`.`dishtype_id`
		left join `diet` `di` on `di`.`id` = `d`.`diet_id`
		left join `dish_kitchen` `dk` on `dk`.`dish_id` = `d`.`product_id`
		left join `kitchen` `k` on `k`.`id` = `dk`.`kitchen_id`
		left join `user` `u` on `u`.`id` = `p`.`user_id`
		left join `profile_cook` `pc` on `pc`.`user_id` = `u`.`id`
	where
		case
			when param_dishordiet = 'dish' then `d`.`diet_id` is null
			when param_dishordiet = 'diet' then `d`.`diet_id` is not null
			else 1 end
		and `p`.`price` >= param_from
		and `p`.`price` <= param_to
		and if(param_dishtype is not null, FIND_IN_SET(`d`.`dishtype_id`, param_dishtype), 1)
		and
			case
				when param_dishordiet = 'dish' then if(param_kitchen is not null, FIND_IN_SET(`k`.`id`, param_kitchen), 1)
				when param_dishordiet = 'diet' then if(param_kitchen is not null, FIND_IN_SET(`di`.`id`, param_kitchen), 1)
			end
		and if(param_q is not null, `u`.`name` like concat('%',param_q,'%'), 1)
		and ifnull(`pc`.`pickup` = param_pickup, 1)
		and if(param_workhome is not null, `pc`.`workhome` = 1, 1)
		and ifnull(`pc`.`costdelivery` >= param_costdeliveryfrom, 1)
		and ifnull(`pc`.`costdelivery` <= param_costdeliveryto, 1)
		and if(param_costdeliveryfrom is not null or param_costdeliveryto is not null, `pc`.`costdelivery` is not null, 1)
		and `u`.`usertype` = 'cook'
		and `u`.`role` = 10
		and `u`.`status` = 10
	group by `p`.`id`
	limit param_offset, param_rows;
end;;

create procedure `search_cook`(
	in param_offset int,
	in param_rows int,
	in param_dishordiet varchar(255),
	in param_from decimal(8,2),
	in param_to decimal(8,2),
	in param_dishtype varchar(255),
	in param_kitchen varchar(255),
	in param_q varchar(32),
	in param_pickup int,
	in param_workhome int,
	in param_costdeliveryfrom decimal(8,2),
	in param_costdeliveryto decimal(8,2)
)
begin
	select SQL_CALC_FOUND_ROWS
		`u`.`id` as `u_id`,
		GROUP_CONCAT(DISTINCT `p`.`id` SEPARATOR ',') AS `p_id`
	from
		`user` `u`
		left join `product` `p` on `p`.`user_id` = `u`.`id`
		left join `dish` `d` on `d`.`product_id` = `p`.`id`
		left join `diet` `di` on `di`.`id` = `d`.`diet_id`
		left join `dish_kitchen` `dk` on `dk`.`dish_id` = `d`.`product_id`
		left join `kitchen` `k` on `k`.`id` = `dk`.`kitchen_id`
		left join `profile_cook` `pc` on `pc`.`user_id` = `u`.`id`
	where
		`u`.`usertype` = 'cook'
		and `u`.`role` = 10
		and `u`.`status` = 10
		and
			case
				when param_dishordiet = 'dish' then `d`.`diet_id` is null
				when param_dishordiet = 'diet' then `d`.`diet_id` is not null
				else 1
			end
		and `p`.`price` >= param_from
		and `p`.`price` <= param_to
		and ifnull(`d`.`dishtype_id` = param_dishtype, 1)
		and
			case
				when param_dishordiet = 'dish' then if(param_kitchen is not null, FIND_IN_SET(`k`.`id`, param_kitchen), 1)
				when param_dishordiet = 'diet' then if(param_kitchen is not null, FIND_IN_SET(`di`.`id`, param_kitchen), 1)
			end
		and if(param_q is not null, `u`.`name` like concat('%',param_q,'%'), 1)
		and ifnull(`pc`.`pickup` = param_pickup, 1)
		and if(param_workhome is not null, `pc`.`workhome` = 1, 1)
		and ifnull(`pc`.`costdelivery` >= param_costdeliveryfrom, 1)
		and ifnull(`pc`.`costdelivery` <= param_costdeliveryto, 1)
		and if(param_costdeliveryfrom is not null or param_costdeliveryto is not null, `pc`.`costdelivery` is not null, 1)
	group by `u`.`id`
	limit param_offset, param_rows;
end;;

