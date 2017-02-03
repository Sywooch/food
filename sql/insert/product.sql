--

use information_schema;
select *
from
  key_column_usage
where
  referenced_table_name = 'dish'
  and referenced_column_name = 'product_id';

--


use `food`;
set autocommit = 0; set foreign_key_checks = 0; set unique_checks = 0;
truncate table `set_dish`;
truncate table `set`;
truncate table `dish_kitchen`;
truncate table `dish`;
truncate table `product`;
set autocommit = 1; set foreign_key_checks = 1; set unique_checks = 1;

--

start transaction;
insert into `food`.`product` (`user_id`, `header`, `price`, `pricesale`, `type`) values ('15', 'блюдо1', '100.10', '100', 'dish');
set @insid = last_insert_id();
insert into `food`.`dish` (`product_id`, `dishtype_id`, `diet_id`, `weight`, `text`) values (@insid, '1', '1', '100', 'text');
insert into `food`.`dish_kitchen` (`dish_id`, `kitchen_id`) values (@insid, '1');

insert into `food`.`product` (`user_id`, `header`, `price`, `pricesale`, `type`) values ('15', 'для сета1', '100.10', '100', 'dish');
set @insid = last_insert_id();
insert into `food`.`dish` (`product_id`, `dishtype_id`, `diet_id`, `weight`, `text`) values (@insid, '1', '1', '100', 'text');
insert into `food`.`dish_kitchen` (`dish_id`, `kitchen_id`) values (@insid, '1');

insert into `food`.`product` (`user_id`, `header`, `price`, `pricesale`, `type`) values ('15', 'для сета2', '100.10', '100', 'dish');
set @insid = last_insert_id();
insert into `food`.`dish` (`product_id`, `dishtype_id`, `diet_id`, `weight`, `text`) values (@insid, '1', '1', '100', 'text');
insert into `food`.`dish_kitchen` (`dish_id`, `kitchen_id`) values (@insid, '1');
commit;

--

start transaction;
insert into `food`.`product` (`user_id`, `header`, `price`, `pricesale`, `type`) values ('15', 'сет', '150.10', '150', 'set');
set @insid = last_insert_id();
insert into `food`.`set` (`product_id`,`text`) values (@insid,'2 + 3');
insert into `food`.`set_dish` (`set_id`,`dish_id`) values (@insid,2);
insert into `food`.`set_dish` (`set_id`,`dish_id`) values (@insid,3);
commit;

--

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
where dks.kitchen_id = 1 or dk.kitchen_id = 1
group by p.id
