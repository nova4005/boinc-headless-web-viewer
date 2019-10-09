<?php

class AccountManager extends RPC {
    public function get_account_manager_info()
    {
        return $this->request("<acct_mgr_info/>");
    }
}