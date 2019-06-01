<?php
namespace Libs;

class MySession extends \SessionHandler {
    private $_handle;
    /**
     * Initialize session
     * @link http://www.php.net/manual/en/sessionhandler.open.php
     * @param save_path string <p>
     * The path where to store/retrieve the session.
     * </p>
     * @param session_id string <p>
     * The session id.
     * </p>
     * @return bool The return value (usually true on success, false on failure). Note this value is returned internally to PHP for processing.
     */
    public function open ($save_path, $session_id) {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        
        if ($redis) {
            $this->_handle = $redis;
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Close the session
     * @link http://www.php.net/manual/en/sessionhandler.close.php
     * @return bool The return value (usually true on success, false on failure). Note this value is returned internally to PHP for processing.
     */
    public function close () {
        return $this->_handle->close();
    }
    
    /**
     * Read session data
     * @link http://www.php.net/manual/en/sessionhandler.read.php
     * @param session_id string <p>
     * The session id to read data for.
     * </p>
     * @return string an encoded string of the read data. If nothing was read, it must return an empty string. Note this value is returned internally to PHP for processing.
     */
    public function read ($session_id) {
        $sess = $this->_handle->get($session_id);
        if ($sess) {
            return serialize($sess);
        } else {
            return '';
        }
    }
    
    /**
     * Write session data
     * @link http://www.php.net/manual/en/sessionhandler.write.php
     * @param session_id string <p>
     * The session id.
     * </p>
     * @param session_data string <p>
     * The encoded session data. This data is the result of the PHP internally encoding the $_SESSION superglobal to a serialized
     * string and passing it as this parameter. Please note sessions use an alternative serialization method.
     * </p>
     * @return bool The return value (usually true on success, false on failure). Note this value is returned internally to PHP for processing.
     */
    public function write ($session_id, $session_data) {
        return $this->_handle->set($session_id, $session_data);
    }
    
    /**
     * Destroy a session
     * @link http://www.php.net/manual/en/sessionhandler.destroy.php
     * @param session_id string <p>
     * The session ID being destroyed.
     * </p>
     * @return bool The return value (usually true on success, false on failure). Note this value is returned internally to PHP for processing.
     */
    public function destroy ($session_id) {
        return $this->_handle->del($session_id);
    }
    
    /**
     * Cleanup old sessions
     * @link http://www.php.net/manual/en/sessionhandler.gc.php
     * @param maxlifetime int <p>
     * Sessions that have not updated for the last maxlifetime seconds will be removed.
     * </p>
     * @return bool The return value (usually true on success, false on failure). Note this value is returned internally to PHP for processing.
     */
    public function gc ($maxlifetime) {
        return true;
    }
    
}