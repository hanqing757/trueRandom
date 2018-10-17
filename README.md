# trueRandom
基于random.org提供的API生成真正的随机数，包括整数序列、小数序列、高斯分布、字符串、uuid、二进制大对象（blob）。

在使用前先去random.org申请一个API key, 对每个API key限制了每天生成的随机数或随机字符串的数量，相关信息将会在每次获取随机数时一并返回。
# 安装
通过composer，在你的composer.json文件中添加如下
```
"require":{
    "luffy/randomizer":"*"
}
```
# 使用
```php
use  luffy\random\Randomizer;
$generator=new Randomizer('449c131f-0171-401e-80c9-xxxxxxxxx'); //参数是你在random.org申请的API key
```
# 生成整数序列
参数依次表示随机数个数，最小值，最大值，进制（2/8/10/16），是否允许重复出现随机数
```php
$generator->integers($quantity,$min,$max,$base=10,$replacement=true)
```
返回一个数组
```php
array(3) {
  ["errno"]=>
  int(0)
  ["error"]=>
  string(7) "success"
  ["data"]=>
  array(10) {
    [0]=>
    int(22)
    [1]=>
    int(9)
    [2]=>
    int(89)
    [3]=>
    int(98)
    [4]=>
    int(79)
    [5]=>
    int(1)
    [6]=>
    int(3)
    [7]=>
    int(83)
    [8]=>
    int(67)
    [9]=>
    int(29)
  }
}

```
出错时返回如下，比如$base出错
```php
array(3) {
  ["errno"]=>
  int(201)
  ["error"]=>
  string(34) "Parameter 'base' has illegal value"
  ["data"]=>
  NULL
}
```
# 生成浮点数随机数
参数依次表示随机数个数，小数位数，$replacement同上
```php
$generator->decimalFractions($quantity,$decimalPlaces,$replacement=true)
```
返回数据格式同上
# 生成高斯分布随机数
参数依次表示随机数个数，均值，方差，有效数字
```php
$generator->gaussians($quantity,$mean,$standardDeviation,$significantDigits)
```
# 生成随机字符串
参数依次表示 随机字符串个数，字符串长度，选取的字符集
```php
$generator->strings($quantity,$length,$characters,$replacement=true)
```
# 生成随机的uuid
参数表示uuid的个数
```php
$generator->uuids($quantity)
```
# 生成二进制大对象blob
参数依次表示随机blob个数，blob长度（bit）,返回数据的编码格式
```php
$generator->blobs($quantity,$size,$format='base64')
```
# 查看API key当前的状态信息
```php
$generator->usage();
```
返回数据如下
```php
array(3) {
  ["errno"]=>
  int(0)
  ["error"]=>
  string(7) "success"
  ["data"]=>
  array(6) {
    ["status"]=>
    string(7) "running"
    ["creationTime"]=>
    string(20) "2018-09-30 08:17:55Z"
    ["bitsLeft"]=>
    int(249604)
    ["requestsLeft"]=>
    int(994)
    ["totalBits"]=>
    int(21471)
    ["totalRequests"]=>
    int(99)
  }
}
```