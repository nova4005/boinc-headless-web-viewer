<?php

class RPC {

    protected $socket;
    protected $address;
    protected $port;
    protected $connect;
    protected $password;

    public function __construct($address = 'localhost', $port = '31416', $password = '')
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, 0);
        $this->address = $address;
        $this->port = $port;
        $this->connect = $this->connect();
        $this->password = $password;
        $this->authenticate();
    }

    protected function connect()
    {
        return socket_connect($this->socket, $this->address, $this->port);
    }

    public function authenticate()
    {
        $command = "<auth1/>";
        $nonce = $this->request($command);
        $nonce = filter_var($nonce, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $key = strtolower(md5($nonce . $this->password));
        $command = "<auth2><nonce_hash>$key</nonce_hash></auth2>";
        return $this->request($command);
    }

    public function request($command)
    {
        $request = $this->build_request($command);
        $auth = socket_write($this->socket, $request);
        $response = '';
        while(($read = socket_read($this->socket, 1)) !== false) {
            $response .= $read;
            if (preg_match("</boinc_gui_rpc_reply>", $response)) {
                break;
            }
        }
        return $response;
    }
    
    protected function build_request($command)
    {
        return "<boinc_gui_rpc_request>$command</boinc_gui_rpc_request>\003";
    }

    public function get_state()
    {
        return $this->request("<get_state/>");
    }

    public function get_simple_gui_info()
    {
        return $this->request("<get_simple_gui_info/>");
    }
}