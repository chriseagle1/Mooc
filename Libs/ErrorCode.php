<?php
namespace Libs;

class ErrorCode {
    const USERNAME_EXISTS = 10001;
    const USERNAME_NOT_EMPTY = 10002;
    const PASSWORD_NOT_EMPTY = 10003;
    const REGISTER_FAIL = 10004;
    const USER_OR_PWD_WRONG = 10005;
    
    const ARTICLE_TITLE_NOT_EMPTY = 10006;
    const ARTICLE_CONTNET_NOT_EMPTY = 10007;
    const ARTICLE_CREATE_FAIL = 10008;
    const ARTICLE_ID_NOT_EMPTY = 10009;
    const ARTICLE_NOT_EXISTS = 10010;
    const PERMISSION_DENY = 10011;
    const ARTICLE_EDIT_FAIL = 10012;
    const ARTICLE_DEL_FAIL = 10013;
}