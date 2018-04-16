<?php
namespace Qiniu\Pili;

class AppClient
{
    private $_transport;
    private $_mac;
    private $_baseURL;

    public function __construct($mac)
    {
        $this->_mac = $mac;
        $this->_transport = new Transport($mac);

        $cfg = Config::getInstance();
        $this->_baseURL = sprintf("%s/%s/apps", $cfg->RTCAPI_HOST, $cfg->RTCAPI_VERSION);
    }

    /*
     * ownerId: 要创建房间的所有者
     * appId: 房间名称
     */
    public function createApp($hub, $title, $maxUsers = null, $noAutoCloseRoom = null, $noAutoCreateRoom = null, $noAutoKickUser = null)
    {
        $params['hub'] = $hub;
        $params['title'] = $title;
        if (!empty($maxUsers)) {
            $params['maxUsers'] = $maxUsers;
        }
        if (!empty($noAutoCloseRoom)) {
            $params['noAutoCloseRoom'] = $noAutoCloseRoom;
        }
        if (!empty($noAutoCreateRoom)) {
            $params['noAutoCreateRoom'] = $noAutoCreateRoom;
        }
        if (!empty($noAutoKickUser)) {
            $params['noAutoKickUser'] = $noAutoKickUser;
        }
        $body = json_encode($params);
        try {
            $ret = $this->_transport->send(HttpRequest::POST, $this->_baseURL, $body);
        } catch (\Exception $e) {
            return $e;
        }
        return $ret;
    }

    /*
     * ownerId: 要创建房间的所有者
     * appId: 房间名称
     */
    public function updateApp($appId, $hub, $title, $maxUsers = null, $mergePublishRtmp = null, $noAutoCloseRoom = null, $noAutoCreateRoom = null, $noAutoKickUser = null)
    {
        $url = $this->_baseURL . '/' . $appId;
        $params['hub'] = $hub;
        $params['title'] = $title;
        if (!empty($maxUsers)) {
            $params['maxUsers'] = $maxUsers;
        }
        if (!empty($noAutoCloseRoom)) {
            $params['noAutoCloseRoom'] = $noAutoCloseRoom;
        }
        if (!empty($noAutoCreateRoom)) {
            $params['noAutoCreateRoom'] = $noAutoCreateRoom;
        }
        if (!empty($noAutoKickUser)) {
            $params['noAutoKickUser'] = $noAutoKickUser;
        }
        if (!empty($mergePublishRtmp)) {
            $params['mergePublishRtmp'] = $mergePublishRtmp;
        }
        $body = json_encode($params);
        try {
            $ret = $this->_transport->send(HttpRequest::POST, $url, $body);
        } catch (\Exception $e) {
            return $e;
        }
        return $ret;
    }

    /*
     * appId: 房间名称
     */
    public function getApp($appId)
    {
        $url = $this->_baseURL . '/' . $appId;
        try {
            $ret = $this->_transport->send(HttpRequest::GET, $url);
        } catch (\Exception $e) {
            return $e;
        }
        return $ret;
    }

    /*
     * appId: 房间名称
     */
    public function deleteApp($appId)
    {
        $url = $this->_baseURL . '/' . $appId;
        try {
            $ret = $this->_transport->send(HttpRequest::DELETE, $url);
        } catch (\Exception $e) {
            return $e;
        }
        return $ret;
    }

    /*
     * 获取房间的人数
     * appId: 房间名称
     */
    public function getappUserNum($appId, $roomName)
    {
        $url = sprintf("%s/%s/rooms/%s/users", $this->_baseURL, $appId, $roomName);
        try {
            $ret = $this->_transport->send(HttpRequest::GET, $url);
        } catch (\Exception $e) {
            return $e;
        }
        return $ret;
    }

   /*
    * 踢出玩家
    * appId: 房间名称
    * userId: 请求加入房间的用户ID
    */
    public function kickingPlayer($appId, $roomName, $UserId)
    {
        $url = sprintf("%s/%s/rooms/%s/users/%s", $this->_baseURL, $appId, $roomName, $UserId);
        try {
            $ret = $this->_transport->send(HttpRequest::DELETE, $url);
        } catch (\Exception $e) {
            return $e;
        }
        return $ret;
    }

    /*
     * 获取房间的人数
     * appId: 房间名称
     */
    public function listRooms($appId, $prefix, $offset, $limit)
    {
        $url = sprintf("%s/%s/rooms", $this->_baseURL, $appId);
        try {
            $ret = $this->_transport->send(HttpRequest::GET, $url);
        } catch (\Exception $e) {
            return $e;
        }
        return $ret;
    }

    /*
     * appId: 房间名称
     * userId: 请求加入房间的用户ID
     * perm: 该用户的房间管理权限，"admin"或"user"，房间主播为"admin"，拥有将其他用户移除出房间等特权。
     * expireAt: int64类型，鉴权的有效时间，传入秒为单位的64位Unix时间，token将在该时间后失效。
     */
    public function appToken($appId, $roomName, $userId, $expireAt, $permission)
    {
        $params['appId'] = $appId;
        $params['userId'] = $userId;
        $params['roomName'] = $roomName;        
        $params['permission'] = $permission;
        $params['expireAt'] = $expireAt;
        $appAccessString = json_encode($params);
        $encodedappAccess = Utils::base64UrlEncode($appAccessString);
        $sign = hash_hmac('sha1', $encodedappAccess, $this->_mac->_secretKey, true);
        $encodedSign = Utils::base64UrlEncode($sign);
        return $this->_mac->_accessKey . ":" . $encodedSign . ":" . $encodedappAccess;
    }
}
