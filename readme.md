###说明

下面没有列出请求失败的情况，如果返回不是2XX就为失败
在request中的 `[*XXX*]` 为请求参数的位置, 以下是一些说明
- formData: 请求为表单格式，该项在请求的body中
- query: 该参数在url中指明，如 http://{host}/a?query=value
- path: 该参数在url的指定路径，如 http://{host}/{path}
- any: query或formData

response返回基本都是json类型，其旁边有注明。
在json的参数中会有`[int]`信息来指明该项数据类型, 未标注默认是`[string]`。

###API
**host:** 120.27.131.127:12450

**auth**
- mothod: *POST*
- description: 用户登录
- request
	- username: [*formData*] 用户名
	- password: [*formData*] 密码
- response(json)
```
{
	user: {
    	id[int]: 用户id,
        username: 用户名,
        money[double]: 余额,
        created_at: 创建时间
    }，
    token: token字符串,
    token_expired_at: token过期时间，过期后需重新登录
}
```

**register**
- method: *POST*
- description: 用户注册
- request
	- username: [*formData*] 用户名 (1~32)
	- password: [*formData*] 密码 (6~64)
- response(json)
```
{
	id[int]: 用户id,
    username: 用户名,
    money[double]: 余额,
    created_at: 创建时间
}
```

**user/{id}**
- method: *GET*
- description: 得到指定id的用户信息
- request
	- id: [*path*] 用户的id
- response(json)
```
{
	id[int]: 用户id,
    username: 用户名,
    money[double]: 余额,
    created_at: 创建时间
}
```

**user/{id}/tradeList**
- method: *GET*
- description: 得到用户的交易记录
- request
	- id: [*path*] 用户id
	- offset: [*query*] 查找的偏移量, 默认0
	- limit: [*query*] 返回的最多交易数，默认10
- example: http://{host}/user/{id}/tradeList?id={id}&offset={offset}&limit={limit}
- response(json)
```
{
	id[int]: 交易记录的id,
    pay_user_id[int]: 支付用户的id,
    receive_user_id[int]: 收款用户的id,
    money[double]: 交易金额,
    created_at: 交易时间
}
```

**trade**
- method: *POST*
- description: 进行交易
- request
	- token: [*any*] 用户登录得到的token
	- receiver: [*any*] 交易接收者的id
	- money: [*any*] 交易的金额
- response(json)
```
{
	id[int]: 本次交易的id,
    pay_user_id[int]: 支付用户的id,
    receive_user_id[int]: 接收用户的id,
    money[double]: 交易金额,
    created_at: 交易时间
}
```

**recharge**
- method: *POST*
- description: 充值
- request
	- userId: [*any*] 充钱的用户id
	- money: [*any*] 充钱额度
- response(string)
`success`
