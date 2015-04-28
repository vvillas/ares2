<?php
interface IDAO
{
	
	function create(IEntity $obj);

	function read(IEntity $obj);
	
	function update(IEntity $obj);
	
	function delete(IEntity $obj);
	
}