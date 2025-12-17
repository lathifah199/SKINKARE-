"""
Script untuk test Flask server
Jalankan: python test_server.py
"""
import requests
import sys

SERVER_URL = "http://127.0.0.1:5000"

def test_home():
    """Test endpoint home"""
    print("🧪 Testing GET /...")
    try:
        response = requests.get(f"{SERVER_URL}/")
        if response.status_code == 200:
            data = response.json()
            print(f"✅ Server online: {data}")
            return True
        else:
            print(f"❌ Server returned status {response.status_code}")
            return False
    except Exception as e:
        print(f"❌ Connection failed: {e}")
        print("\n💡 Pastikan Flask server berjalan dengan: python app.py")
        return False

def test_precheck():
    """Test endpoint precheck dengan gambar dummy"""
    print("\n🧪 Testing POST /precheck...")
    try:
        # Buat gambar dummy (100x100 pixel hitam)
        import cv2
        import numpy as np
        dummy_image = np.zeros((100, 100, 3), dtype=np.uint8)
        _, buffer = cv2.imencode('.jpg', dummy_image)
        
        files = {'file': ('test.jpg', buffer.tobytes(), 'image/jpeg')}
        response = requests.post(f"{SERVER_URL}/precheck", files=files)
        
        print(f"📊 Status code: {response.status_code}")
        data = response.json()
        print(f"📦 Response: {data}")
        
        # Cek apakah ada field yang diharapkan
        if 'cahaya_ok' in data and 'posisi_ok' in data and 'jarak_ok' in data:
            print("✅ Precheck endpoint working (3 kriteria terpisah)")
            return True
        elif response.status_code in [200, 400]:
            print("✅ Precheck endpoint working")
            return True
        else:
            print(f"❌ Unexpected status: {response.status_code}")
            return False
            
    except Exception as e:
        print(f"❌ Precheck test failed: {e}")
        return False

def test_predict():
    """Test endpoint predict dengan gambar dummy"""
    print("\n🧪 Testing POST /predict...")
    try:
        # Buat gambar dummy (100x100 pixel hitam)
        import cv2
        import numpy as np
        dummy_image = np.zeros((100, 100, 3), dtype=np.uint8)
        _, buffer = cv2.imencode('.jpg', dummy_image)
        
        files = {'file': ('test.jpg', buffer.tobytes(), 'image/jpeg')}
        response = requests.post(f"{SERVER_URL}/predict", files=files)
        
        print(f"📊 Status code: {response.status_code}")
        print(f"📦 Response: {response.json()}")
        
        if response.status_code in [200, 400]:
            print("✅ Predict endpoint working")
            return True
        else:
            print(f"❌ Unexpected status: {response.status_code}")
            return False
            
    except Exception as e:
        print(f"❌ Predict test failed: {e}")
        return False

if __name__ == "__main__":
    print("=" * 50)
    print("🚀 Flask Server Test Suite")
    print("=" * 50)
    
    results = []
    
    # Test 1: Home
    results.append(("Home", test_home()))
    
    # Test 2: Precheck
    results.append(("Precheck", test_precheck()))
    
    # Test 3: Predict
    results.append(("Predict", test_predict()))
    
    # Summary
    print("\n" + "=" * 50)
    print("📊 Test Summary:")
    print("=" * 50)
    
    for test_name, passed in results:
        status = "✅ PASS" if passed else "❌ FAIL"
        print(f"{test_name:<20} {status}")
    
    total_passed = sum(1 for _, passed in results if passed)
    total_tests = len(results)
    
    print(f"\n🎯 Result: {total_passed}/{total_tests} tests passed")
    
    if total_passed == total_tests:
        print("🎉 All tests passed!")
        sys.exit(0)
    else:
        print("⚠️ Some tests failed. Check logs above.")
        sys.exit(1)