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
```
use  luffy\random\Randomizer;
$generator=new Randomizer('449c131f-0171-401e-80c9-xxxxxxxxx'); //参数是你在random.org申请的API key
```
# 生成整数序列
参数依次表示随机数个数，最小值，最大值，进制（2/8/10/16），是否允许重复出现随机数
```
$generator->integers($quantity,$min,$max,$base=10,$replacement=true)
```
返回一个对象
```
object(stdClass)#17 (5) {
  ["random"]=>
  object(stdClass)#30 (2) {
    ["data"]=>
    array(10) {
      [0]=>
      int(13)
      [1]=>
      int(92)
      [2]=>
      int(50)
      [3]=>
      int(94)
      [4]=>
      int(14)
      [5]=>
      int(9)
      [6]=>
      int(17)
      [7]=>
      int(92)
      [8]=>
      int(57)
      [9]=>
      int(30)
    }
    ["completionTime"]=>
    string(20) "2018-10-10 12:33:10Z"
  }
  ["bitsUsed"]=>
  int(66)
  ["bitsLeft"]=>
  int(249934)
  ["requestsLeft"]=>
  int(999)
  ["advisoryDelay"]=>
  int(1420)
}
```
出错时返回如下对象，比如$base出错
```
object(stdClass)#30 (3) {
  ["code"]=>
  int(201)
  ["message"]=>
  string(34) "Parameter 'base' has illegal value"
  ["data"]=>
  array(1) {
    [0]=>
    string(4) "base"
  }
}
```
# 生成浮点数随机数
参数依次表示随机数个数，小数位数，$replacement同上
```
$generator->decimalFractions($quantity,$decimalPlaces,$replacement=true)
```
返回数据格式同上
# 生成高斯分布随机数
参数依次表示随机数个数，均值，方差，有效数字
```
$generator->gaussians($quantity,$mean,$standardDeviation,$significantDigits)
```
# 生成随机字符串
参数依次表示 随机字符串个数，字符串长度，选取的字符集
```
$generator->strings($quantity,$length,$characters,$replacement=true)
```
# 生成随机的uuid
参数表示uuid的个数
```
$generator->uuids($quantity)
```
# 生成二进制大对象blob
参数依次表示随机blob个数，blob长度（bit）,返回数据的编码格式
```
$generator->blobs($quantity,$size,$format='base64')
```
# 查看API key当前的状态信息
```
$generator->usage();
```

