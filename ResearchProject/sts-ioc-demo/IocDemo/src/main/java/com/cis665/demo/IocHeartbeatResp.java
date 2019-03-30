/*******************************************************************
 * 
 * Class:          CIS665
 * Assignment:     Course Project
 * Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
 * Due Date:       5.24.2019 @ 11:59pm
 *
 * Filename:       IocDemoResponse.java
 *   
 *   Defines the structure for an object which is created and used
 *   for the response to a heartbeat request.
 *   
 *******************************************************************/

package com.cis665.demo;

public class IocHeartbeatResp {

    private final long id;
    private final String content;

    public IocHeartbeatResp(long id, String content) {
        this.id = id;
        this.content = content;
    }

    public long getId() {
        return id;
    }

    public String getContent() {
        return content;
    }
}
