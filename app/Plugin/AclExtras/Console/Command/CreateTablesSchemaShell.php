<?php

class CreateTablesSchemaShell extends AppShell
{
    public function main()
    {
        $this->dispatchShell('schema create Acos --plugin AclExtras');
        $this->dispatchShell('schema create Aros --plugin AclExtras');
        $this->dispatchShell('schema create ArosAcos --plugin AclExtras');
    }
}
