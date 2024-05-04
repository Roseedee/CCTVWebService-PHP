# CCTVWebService

## หน้า UI ที่ทำเสร็จแล้ว
- [x] หน้าล็อกอิน(เชื่อมฐานข้อมูลแล้ว)
- [x] แสดงรายชื่อลูกค้าทั้งหมด(เชื่อมฐานข้อมูลแล้ว)
- [x] แสดงหน้างานทั้งหมด
- [x] เพิ่มลูกค้าใหม่
- [x] เพิ่มหน้างานใหม่
- [x] หน้าแจ้งเตือน
- [ ] แสดงรายละเอียดลูกค้า
- [ ] แสดงรายละเอียดหน้างาน
- [ ] โปรไฟล์ Admin
- [ ] ตั้งค่า Admin

## Data Dictionary<br>

__Account_Type__
|Attribute Name|Requied|Format|Comment|
|---|---|---|---|
|account_type_id|Yes|int(11)|รหัสประเภทบัญชี|
|account_type|Yes|str(11)|ประเภทบัญชี|

__Account__
|Attribute Name|Requied|Format|Comment|
|---|---|---|---|
|account_id|Yes|int(11)|รหัสบัญชี|
|username|Yes|str(50)|ชื่อผู้ใช้|
|password|Yes|str(50)|รหัสผ่าน|
|create_at|Yes|datetime|เวลาสมัคร|
|last_signin|Yes|datetime|เวลาล็อกอินล่าสุด|
|account_type_id|Yes|int(11)|รหัสประเภทบัญชี|
|user_id|Yes|int(11)|รหัสผู้ใช้|
