/*******************************************************************
 * 
 * Class:          CIS665
 * Assignment:     Course Project
 * Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
 * Due Date:       5.24.2019 @ 11:59pm
 *
 * Filename:       IocBuildResponse.java
 *   
 *   Defines the structure for an object which is created and used
 *   
 *******************************************************************/

package com.cis665.demo;

public class IoCBuildResponse {

    private final long id;
    private final String content;

    public IoCBuildResponse(long id, String content) {
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
